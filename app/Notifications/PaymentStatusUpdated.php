<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Models\Payment;
use Illuminate\Bus\Queueable;

class PaymentStatusUpdated extends Notification
{
    use Queueable;

    protected $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function via($notifiable)
    {
        // Only send notification if status is not Rejected
        if ($this->payment->status !== 'Rejected') {
            return ['database'];
        }

        return [];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Pemesanan Tiket Bioskop Telah Berhasil",
            'payment_id' => $this->payment->id,
            'status' => $this->payment->status,
            'user_name' => $this->payment->user->name,
        ];
    }
}

