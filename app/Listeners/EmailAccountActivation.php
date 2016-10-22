<?php

namespace App\Listeners;

use App;
use App\Events\UserHasRegistered;
use App\Helpers\Generic;
use App\Models\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailAccountActivation
{
    public $mail;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Handle the event.
     *
     * @param  UserHasRegistered  $event
     * @return void
     */
    public function handle(UserHasRegistered $event)
    {
        $name = $event->user->profile->first_name . ' ' . $event->user->profile->last_name;
        $email = $event->user->email;
        $token = bcrypt($event->user->id . time());

        $link = Generic::getBaseUrl() . '/user/activate?token=' . $token;

        $user = $event->user;
        $user->activation_token = $token;
        $user->save();

        $this->mail->send('emails.account_activation', ['name' => $name, 'link' => $link], function($message) use($email){
            $message->to($email);
            $message->subject('Audit - Activate Your Account');
        });
    }
}
