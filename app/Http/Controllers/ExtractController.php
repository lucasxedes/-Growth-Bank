<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Payment;
use App\Models\Transfer;


class ExtractController extends Controller
{

    public function extractUser(Account $account)
    {
        
        $transfers = Transfer::all();
        // dd($transfers = Transfer::all());
        //$payments = Payment::all();

        return response()->json(['data' => [
            'Transfer' => $transfers,
            //'payment' => $payments,
        ]]);
    }
}
