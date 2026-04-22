<?php

namespace App\Listeners\v1\finance;

class UpdatePayment
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
        $payment = $event->payment;
        $data = $event->data;

        $payment->update([
            'lease_id' => $data['lease_id'],
            'amount' => $data['amount'],
            'payment_date' => $data['payment_date'],
            'payment_method' => $data['payment_method'],
            'transaction_code' => $data['transaction_code'],
            'type' => $data['type'],
            'notes' => $data['type'],
        ]);
    }
}
