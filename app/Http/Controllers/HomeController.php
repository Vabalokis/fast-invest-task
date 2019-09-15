<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionHistory;
use App\User;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $logged_in_user      = auth()->user();
        $transaction_history = TransactionHistory::where('recipient_user_id' , $logged_in_user->id)->orWhere('sender_user_id' , $logged_in_user->id)->orderBy('created_at', 'desc')->get();
        
        $transaction_history_mapped = $transaction_history->map(function ($history_item) {

            if($history_item->sender_user_id == 0) {
                $transfer_target = 0; // Logged in user is the recipient. Sender is the system.
            } else {
                $transfer_target = User::where('id' , $history_item->sender_user_id)->get()[0]->public_id; // Logged in user is the recipient.
            }

            if(auth()->user()->id == $history_item->sender_user_id) { 
                $transfer_target = User::where('id' , $history_item->recipient_user_id)->get()[0]->public_id; // Logged in user is the sender.
            }

            $is_sent = (auth()->user()->id == $history_item->sender_user_id) ? true : false;
            
            return ['date'     => $history_item->created_at->toDateString() ,
                    'money'    => $history_item->money_transfered ,
                    'target'   => $transfer_target ,
                    'is_sent'  => $is_sent ];
                   
        });

        return view('home')->with(['transaction_history' => $transaction_history_mapped]);
    }
}
