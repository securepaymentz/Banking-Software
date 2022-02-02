<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller {

    public function __construct() {
        date_default_timezone_set(get_option('timezone', get_option('timezone', 'Asia/Dhaka')));
    }

    public function transactions_report(Request $request, $view = "") {

        if ($view == '') {
            return view('backend.reports.transfer_report');
        } else if ($view == 'view') {
            $data   = array();
            $date1  = $request->date1;
            $date2  = $request->date2;
            $type   = $request->type;
            $status = $request->status;

            if ($status == "all") {
                $data['report_data'] = Transaction::whereRaw("date(created_at) >= '$date1' AND date(created_at) <= '$date2'")
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $data['report_data'] = Transaction::where('status', $status)
					->whereRaw("date(created_at) >= '$date1' AND date(created_at) <= '$date2'")
                    ->orderBy('id', 'desc')
                    ->get();
            }

            $data['type']   = $request->type;
            $data['status'] = $request->status;
            $data['date1']  = $request->date1;
            $data['date2']  = $request->date2;

            return view('backend.reports.transfer_report', $data);
        }
    }

}