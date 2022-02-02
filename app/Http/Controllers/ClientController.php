<?php

namespace App\Http\Controllers;

use App\Account;
use App\Card;
use App\CardTransaction;
use App\Transaction;
use App\User;
use App\WireTransfer;
use Auth;
use DB;
use Illuminate\Http\Request;
use Validator;

class ClientController extends Controller {

    public function __construct() {
        date_default_timezone_set(get_option('timezone'));
    }

    /* Profile Overview */
    public function overview() {
        $user = Auth::user();
        return view('backend.user_panel.profile_overview', compact('user'));
    }

    /*    View Account details */
    public function view_account_details(Request $request, $id) {
        //$account = Account::where('id',$id)->where('user_id',Auth::id())->first();
        $account = Account::select('accounts.*', DB::raw("((SELECT IFNULL(SUM(amount),0)
                           FROM transactions WHERE dr_cr = 'cr' AND status = 'complete' AND account_id = accounts.id) -
                           (SELECT IFNULL(SUM(amount),0) FROM transactions WHERE dr_cr = 'dr'
                           AND status ='complete' AND account_id = accounts.id)) as balance"))
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->first();
        if ($request->ajax()) {
            return view('backend.user_panel.modal.view_account', compact('account', 'id'));
        }
    }

    /*    View Transaction details */
    public function view_transaction(Request $request, $id) {
        $transaction = Transaction::where('id', $id)->where('user_id', Auth::id())->first();
        if ($request->ajax()) {
            return view('backend.user_panel.modal.view_transaction', compact('transaction', 'id'));
        }
    }

    public function transfer_between_users(Request $request) {
        @ini_set('max_execution_time', 0);
        @set_time_limit(0);

        if (!$request->isMethod('post')) {
            return view('backend.user_panel.transfer.transfer_between_users');
        } else {
            $validator = Validator::make($request->all(), [
                'amount'         => 'required|numeric',
                'debit_account'  => 'required',
                'user_email'     => 'required',
                'credit_account' => 'required|different:debit_account',
            ]);

            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
                } else {
                    return back()->withErrors($validator)
                        ->withInput();
                }
            }

            $user = User::where('email', $request->user_email)->first();
            if (!$user) {
                return back()->with('error', _lang('User account not found !'))->withInput();
            }

            $user_account = Account::where('user_id', $user->id)
                ->where('account_number', $request->credit_account)
                ->first();
            if (!$user_account) {
                return back()->with('error', _lang('Account number not found !'))->withInput();
            }

            $account  = Account::find($request->debit_account);
            $account2 = Account::find($request->credit_account);

            //Generate Fee
            $fee = generate_fee($request->amount, get_option('tbu_fee', 0), get_option('tbu_fee_type', 'percent'));

            //Check available balance
            if (get_account_balance($request->debit_account) < ($request->amount + $fee)) {
                return back()->with('error', _lang('Insufficient balance !'));
            }

            DB::beginTransaction();

            /* Status will only apply on credit account */
            $status = 'complete';

            //Make Debit Transaction
            $debit             = new Transaction();
            $debit->user_id    = Auth::id();
            $debit->amount     = $request->input('amount');
            $debit->account_id = $request->input('debit_account');
            $debit->dr_cr      = 'dr';
            $debit->type       = 'transfer';
            $debit->status     = $status;
            $debit->note       = $request->input('note');
            $debit->created_by = Auth::id();
            $debit->updated_by = Auth::id();
            $debit->save();

            //Make fee Transaction
            if ($fee > 0) {
                $fee_debit             = new Transaction();
                $fee_debit->user_id    = Auth::id();
                $fee_debit->amount     = $fee;
                $fee_debit->account_id = $request->input('debit_account');
                $fee_debit->dr_cr      = 'dr';
                $fee_debit->type       = 'fee';
                $fee_debit->status     = $status;
                $fee_debit->parent_id  = $debit->id;
                $fee_debit->note       = _lang('Transfer Between User Fee');
                $fee_debit->created_by = Auth::id();
                $fee_debit->updated_by = Auth::id();
                $fee_debit->save();
            }

            //Make Credit Transaction
            $credit             = new Transaction();
            $credit->user_id    = $user_account->id;
            $credit->account_id = $user_account->id;
            $credit->amount     = $request->amount;
            $credit->dr_cr      = 'cr';
            $credit->type       = 'transfer';
            $credit->status     = $status;
            $credit->parent_id  = $debit->id;
            $credit->note       = $request->input('note');
            $credit->created_by = Auth::id();
            $credit->updated_by = Auth::id();
            $credit->save();

            DB::commit();

            if ($credit->id > 0) {
                if ($status == 'complete') {

                    //Registering Event
                    //event(new \App\Events\DepositMoney($credit));

                    return back()->with('success', _lang('Money Transfer Sucessfully'));
                } else {
                    return back()->with('success', _lang('Your Transfer is now under review. You will be notfied shortly after reviewing by authority.'));
                }
            } else {
                return back()->with('error', _lang('Error Occured, Please try again !'));
            }
        }
    }

    /** Card Funding Transfer **/
    public function card_funding_transfer(Request $request) {
        @ini_set('max_execution_time', 0);
        @set_time_limit(0);

        if (!$request->isMethod('post')) {
            return view('backend.user_panel.transfer.card_funding_transfer');
        } else {
            $validator = Validator::make($request->all(), [
                'amount'        => 'required|numeric',
                'debit_account' => 'required',
                'card'          => 'required',
            ]);

            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
                } else {
                    return back()->withErrors($validator)
                        ->withInput();
                }
            }

            $account = Account::find($request->debit_account);
            $card    = Card::find($request->card);

            //Generate Fee
			$fee = generate_fee($request->amount, get_option('cft_fee', 0), get_option('cft_fee_type', 'percent'));

            //Check available balance
            if (get_account_balance($request->debit_account) < ($request->amount + $fee)) {
                return back()->with('error', _lang('Insufficient balance !'));
            }

            DB::beginTransaction();

            /* Status will only apply on credit account */
            $status = 'pending';

            //Make Debit Transaction
            $debit             = new Transaction();
            $debit->user_id    = Auth::id();
            $debit->amount     = $request->input('amount');
            $debit->account_id = $request->input('debit_account');
            $debit->dr_cr      = 'dr';
            $debit->type       = 'card_transfer';
            $debit->status     = 'pending';
            $debit->note       = $request->input('note');
            $debit->created_by = Auth::id();
            $debit->updated_by = Auth::id();
            $debit->save();

            //Create Card Transfer Details
            $cardtransaction                 = new CardTransaction();
            $cardtransaction->card_id        = $request->input('card');
            $cardtransaction->dr_cr          = 'cr';
            $cardtransaction->amount         = $debit->amount;
            $cardtransaction->note           = $request->input('note');
            $cardtransaction->status         = 0;
            $cardtransaction->transaction_id = $debit->id;
            $cardtransaction->created_by     = Auth::id();
            $cardtransaction->updated_by     = Auth::id();

            $cardtransaction->save();

            //Make fee Transaction
            if ($fee > 0) {
                $fee_debit             = new Transaction();
                $fee_debit->user_id    = Auth::id();
                $fee_debit->amount     = $fee;
                $fee_debit->account_id = $request->input('debit_account');
                $fee_debit->dr_cr      = 'dr';
                $fee_debit->type       = 'fee';
                $fee_debit->status     = 'pending';
                $fee_debit->parent_id  = $debit->id;
                $fee_debit->note       = _lang('Card Funding Transfer Fee');
                $fee_debit->created_by = Auth::id();
                $fee_debit->updated_by = Auth::id();
                $fee_debit->save();
            }

            DB::commit();

            if ($cardtransaction->transaction_id > 0) {
                if ($status == 'complete') {
                    return back()->with('success', _lang('Money Transfer Sucessfully'));
                } else {
                    return back()->with('success', _lang('Your Card Funding Transfer is processing. You will be notfied within 2-3 business days after reviewing by authority. Your Money will be returned back to your debit account if authority reject your transfer.'));
                }
            } else {
                return back()->with('error', _lang('Error Occured, Please try again !'));
            }
        }

    }

}