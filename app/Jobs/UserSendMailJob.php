<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserSendMail;

class UserSendMailJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private $id)
    {
        //
    }

    public function handle(): void
    {
        $user = User::find($this->id);
        Mail::to($user->email)->later(now()->addMinute(), new UserSendMail($user));
    }
}
