<?php

namespace App\Http\Controllers;

use App\Account;
use App\Card;
use App\Transaction;
use Auth;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        if (Auth::user()->user_type == 'admin') {
            $data                     = array();
            $data['total_user_count'] = DB::table('users')
                ->where('user_type', 'user')
                ->count();

            $data['pending_card_transaction'] = DB::table('card_transactions')
                ->where('status', 0)
                ->count();

            $data['total_deposit'] = DB::table('deposit')
                ->join('accounts', 'deposit.account_id', 'accounts.id')
                ->selectRaw('SUM(amount) as amount')
                ->first()->amount;

            $data['total_withdraw'] = DB::table('withdraw')
                ->join('accounts', 'withdraw.account_id', 'accounts.id')
                ->selectRaw('SUM(amount) as amount')
                ->first()->amount;

            $data['recent_transactions'] = Transaction::limit(20)
                ->orderBy('id', 'desc')
                ->get();

            return view('backend.dashboard-admin', $data);

        } else {
            $user = Auth::user();

            $data = array();

            $data['accounts'] = Account::select('accounts.*', DB::raw("((SELECT IFNULL(SUM(amount),0)
                               FROM transactions WHERE dr_cr = 'cr' AND status = 'complete' AND account_id = accounts.id) -
                               (SELECT IFNULL(SUM(amount),0) FROM transactions WHERE dr_cr = 'dr'
                               AND status != 'reject' AND account_id = accounts.id)) as balance"))
                ->where('accounts.user_id', $user->id)
                ->get();
            $data['cards'] = Card::select('cards.*', DB::raw("((SELECT IFNULL(SUM(amount),0)
                             FROM card_transactions WHERE dr_cr = 'cr' AND status = 1 AND card_id = cards.id) -
                             (SELECT IFNULL(SUM(amount),0) FROM card_transactions WHERE dr_cr = 'dr'
                             AND status = 1 AND card_id = cards.id)) as balance"))
                ->where('cards.user_id', $user->id)
                ->orderBy('id', 'desc')
                ->get();

            $data['recent_transactions'] = Transaction::where('user_id', $user->id)
                ->orderBy('id', 'desc')
                ->limit(10)
                ->get();

            return view('backend.user_panel.dashboard-user', $data);

        }
    }

    public function json_month_wise_deposit(Request $request) {
        $currency = $request->session()->get('currency');
        $date     = date("Y-m-d");

        $deposits = DB::select("SELECT m.month, IFNULL(SUM(transactions.amount),0) as amount
        FROM ( SELECT 1 AS MONTH UNION SELECT 2 AS MONTH UNION SELECT 3 AS MONTH UNION SELECT 4 AS MONTH
        UNION SELECT 5 AS MONTH UNION SELECT 6 AS MONTH UNION SELECT 7 AS MONTH UNION SELECT 8 AS MONTH
        UNION SELECT 9 AS MONTH UNION SELECT 10 AS MONTH UNION SELECT 11 AS MONTH UNION SELECT 12 AS MONTH ) AS m
        LEFT JOIN transactions ON m.month = MONTH(transactions.created_at) AND YEAR(transactions.created_at) = YEAR('$date')
        AND type = 'deposit' GROUP BY m.month ORDER BY m.month ASC");

        $months         = '"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"';
        $deposit_string = '';

        foreach ($deposits as $d) {
            $deposit_string = $deposit_string . $d->amount . ",";
        }

        $deposit_string = rtrim($deposit_string, ",");

        echo '{ "Months":[' . $months . '], "Deposit":[' . $deposit_string . '] }';
        exit();
    }

    public function json_month_wise_withdraw(Request $request) {
        $currency = $request->session()->get('currency');
        $date     = date("Y-m-d");

        $withdraw = DB::select("SELECT m.month, IFNULL(SUM(transactions.amount),0) as amount
        FROM ( SELECT 1 AS MONTH UNION SELECT 2 AS MONTH UNION SELECT 3 AS MONTH UNION SELECT 4 AS MONTH
        UNION SELECT 5 AS MONTH UNION SELECT 6 AS MONTH UNION SELECT 7 AS MONTH UNION SELECT 8 AS MONTH
        UNION SELECT 9 AS MONTH UNION SELECT 10 AS MONTH UNION SELECT 11 AS MONTH UNION SELECT 12 AS MONTH ) AS m
        LEFT JOIN transactions ON m.month = MONTH(transactions.created_at) AND YEAR(transactions.created_at) = YEAR('$date')
        AND type = 'withdraw' GROUP BY m.month ORDER BY m.month ASC");

        $months          = '"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"';
        $withdraw_string = '';

        foreach ($withdraw as $w) {
            $withdraw_string = $withdraw_string . $w->amount . ",";
        }

        $withdraw_string = rtrim($withdraw_string, ",");

        echo '{ "Months":[' . $months . '], "Withdraw":[' . $withdraw_string . '] }';
        exit();

    }

}
