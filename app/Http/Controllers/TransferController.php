<?php

namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{

    public function transferUser(Request $request)
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

        $transfers = Transfer::create([
            'id_account' => $account->id,
            'value' => $request->value,
            'account_received' => $leavingAccount->id,
        ]);

        return response()->json(['data' => [
            'enteringAccounts' => $leavingAccount,
            'leavingAccount' => $enteringAccount,
            'Transfers' => $transfers
            ]]);
        
    }
}
