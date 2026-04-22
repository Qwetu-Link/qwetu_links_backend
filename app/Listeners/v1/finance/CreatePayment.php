<?php

namespace App\Listeners\v1\finance;

use App\Models\finance\Payment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePayment
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $owner = $event->user;
        $data = $event->data;

        $payment = Payment::create([
            'lease_id' => $data['lease_id'],
            'amount' => $data['amount'],
            'payment_date' => $data['payment_date'],
            'payment_method' => $data['payment_method'],
            'transaction_code' => $data['transaction_code'],
            'invoice_id' => $data['invoice_id'],
            'type' => $data['type'],
            'notes' => $data['type'],
            'business_id' => $owner->business_id,

        ]);

        $event->payment = $payment;
    }
}
