<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $status;
    public $userName;
    public $url;

    public function __construct($status, $userName, $url)
    {
        $this->status = $status;
        $this->userName = $userName;
        $this->url = $url;
    }

    public function build()
    {
        return $this->view('emails.payment_status_updated')
                    ->with([
                        'status' => $this->status,
                        'userName' => $this->userName,
                        'url' => $this->url,
                    ]);
    }
}
