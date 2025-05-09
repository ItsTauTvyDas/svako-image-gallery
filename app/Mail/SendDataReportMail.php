<?php

namespace App\Mail;

use App\Http\Controllers\PDFController;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendDataReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public array $data;

    public function __construct(User $user, array $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    public function build(): SendDataReportMail
    {
        $pdf = Pdf::loadView(PDFController::VIEW, $this->data);

        return $this->from(config('mail.from.address'))
            ->subject(__('Duomenų ataskaita!'))
            ->text('emails.data-report')
            ->attachData($pdf->output(), PDFController::FILE_NAME, [
                'mime' => 'application/pdf'
            ]);
    }
}
