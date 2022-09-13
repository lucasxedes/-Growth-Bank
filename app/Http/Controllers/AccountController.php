<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
   

    public function account(Request $request)
    {
        $account = Account::Create([
            'id_agency' => $request->id_agency,
            'user_id' => $request->user_id,
            'user_password' => $request->user_password,
            'balance' => $request->balance,
            'account_number' => rand(1000, 9999999,)
           ]);

           return response()->json($account);
    }
}
