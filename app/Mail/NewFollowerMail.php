<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewFollowerMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user, $follower;

    public function __construct(User $user, User $follower)
    {
        $this->user = $user;
        $this->follower = $follower;
    }

    public function build(): NewFollowerMail
    {
        return $this->from(config('mail.from.address'))
            ->subject(__('Naujas sekėjas!'))
            ->text('emails.new-follower');
    }
}
