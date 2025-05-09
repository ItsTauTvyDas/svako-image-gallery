<?php

namespace App\Livewire\Dashboard;

use App\Http\Controllers\PDFController;
use App\Mail\SendDataReportMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class AccountDataReport extends Component
{
    public function sendToMail(): void
    {
        $loggedInUser = auth()->user();
        // 1 request'as per 5 min
        $status = RateLimiter::attempt(
            "send-account-data-report00:$loggedInUser->id",
            1,
            function () use ($loggedInUser) {
                Mail::to($loggedInUser->email)->send(new SendDataReportMail($loggedInUser, PDFController::getData()));
                session()->flash('message', __('Ataskaita sėkmingai išsiųsta!'));
            },
            60 * 5
        );
        if (!$status)
            session()->flash('message', __('Ataskaita galima išsiųsti į savo paštą tik kas 5 minutes!'));
    }
}
