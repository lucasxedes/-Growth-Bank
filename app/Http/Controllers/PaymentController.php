<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Account;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\ticketGenerator;

class PaymentController extends Controller
{
    public function ticket(Request $request)
    {
        //$account_number = auth()->user()->account->account_number;
        $account = auth()->user()->account;

        $generator = ticketGenerator::create([
            'id_account' => $account->id,
            'ticket_generator' => rand(1000, 99999999),
            'value' => $request->value,
            'account_number_generator' => $account->account_number,
        ]);
        // dd($generator);
        return response()->json($generator);
    }

    public function index(Request $request)
    {
        try {
            $ticketAccount = ticketGenerator::where("ticket_generator", $request->from_ticket_code)->first();
            //dd($ticketAccount);
            //dd($ticketAccount->account_number_generator);
            $enteringAccount = Account::where("account_number", $ticketAccount->account_number_generator)->first();
            //dd($enteringAccount);
            $leavingAccount = Account::where("account_number", $request['to_account_number'])->first();
          
            if (!$leavingAccount) {
                throw new Exception('There is no proxy user', 400);
            }
            //dd($leavingAccount);
            if ($leavingAccount->balance < $request['value']) {
                throw new \Exception('Insufficient funds', 400);
            }
            //dd('att ok');
            
            $account = auth()->user()->account;
            //dd($account);
            $leavingAccount->balance = $leavingAccount->balance - $request->value;
            $leavingAccount->save();
            //dd($leavingAccount->balance);
            $enteringAccount->balance = $enteringAccount->balance + $request['value'];
            //dd($enteringAccount->balance);
            $enteringAccount->save();

            $payments = Payment::create([
                'id_account' => $account->id,
                'to_account_number' => $request->to_account_number,
                'from_ticket_code' => $request->from_ticket_code,
                'value' => $request->value,
                'account_received' => $enteringAccount->account_number,
            ]);

            return response()->json(['data' => [
                'Payments successful' => $payments
            ]]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
