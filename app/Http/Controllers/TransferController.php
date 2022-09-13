<?php

namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{

    public function transferUser(Request $request)
    {
        $toAccount = Account::find($request->id);

        if(!$toAccount)
        {
            return response()->json(['message' =>'There is no proxy user']);
        }

        $account = auth()->user()->account;
        
        $transfers = Transfer::create([
            'id_account' => $account->id,
            'value' => $request->value,
            'account_received' => $toAccount->id
        ]);
        
        $toAccount->balance = $toAccount->balance - $request->value;
        $toAccount->save();
        

        return response()->json(['data' => [
            'Accounts' => $toAccount, 
            'Transfers' => $transfers
            ]]);
        
    }
}
