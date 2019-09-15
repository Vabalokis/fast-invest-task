<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TransactionHistory;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Sending the money to specified user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function send(Request $data)
    {
        $money_transfered    = $data['amount'];
        $recipient_public_id = $data['recipient'];

        if(!$recipient_public_id) {
            return back()->withErrors(['Recipient\'s public identifier is invalid.']);
        }

        if(User::where('public_id', $recipient_public_id)->get()->isEmpty()) {
            return back()->withErrors(['Recipient\'s public identifier was not found.']);
        }

        $sender              = auth()->user();
        $recipient           = User::where('public_id', $recipient_public_id)->get()[0];

        if ($money_transfered > $sender->money) {
            return back()->withErrors(['You don\'t have enought money to transfer your desired amount.']);
        }

        if($money_transfered <= 0 && $money_transfered != null) {
            return back()->withErrors(['You can\'t send 0 or negative amount of money.']);
        }

        if(!is_numeric($money_transfered) || $money_transfered == null){
            return back()->withErrors(['The amount of money you entered is invalid.']);
        }

        $sender->money     = $sender->money - $money_transfered;
        $sender->save();

        $recipient->money  = $recipient->money + $money_transfered;
        $recipient->save();

        TransactionHistory::create([
            'sender_user_id' => auth()->user()->id,
            'recipient_user_id' => $recipient->id,
            'money_transfered' => $money_transfered
        ]);

        return back();
    }
}
