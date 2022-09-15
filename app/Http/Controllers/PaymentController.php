<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $leavingAccount = Account::find($request->id);
        $enteringAccount = Account::find($request->id)->first();
        if(!$leavingAccount)
        {
            return response()->json(['message' =>'There is no proxy user']);
        }

        $account = auth()->user()->account;
        $leavingAccount->balance = $leavingAccount->balance + $request->value;
        $leavingAccount->save();

        $enteringAccount->balance = $enteringAccount->balance - $request->value;
        $enteringAccount->save();

        $payments = Payment::create([
            'id_account' => $account->id,
            'value' => $request->value,
            'account_received' => $leavingAccount->id
        ]);

        return response()->json(['data' => [
            'OfPaymentAccount' => $leavingAccount,
            'paymentAccount' => $enteringAccount,
            'payments' => $payments
        ]]);
    }
}
