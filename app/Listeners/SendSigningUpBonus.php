<?php

namespace App\Listeners;

use App\User;
use App\TransactionHistory;
use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSigningUpBonus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Sending 1000 euros signing bonus to newly registered user.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $signing_bonus_amount = 1000;

        TransactionHistory::create([
            'sender_user_id' => 0, // 0 - system/administrator public id.
            'recipient_user_id' => $event->user->id,
            'money_transfered' => $signing_bonus_amount
        ]);

        $event->user->money = $signing_bonus_amount;
        $event->user->save();

    }
}
