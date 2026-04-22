<?php

namespace App\Listeners\v1\finance;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateInvoice
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
        $invoice = $event->invoice;
        $data = $event->data;

        $invoice->update([
            'lease_id' => $data['lease_id'],
            'amount' => $data['amount'],
            'paid_amount' => $data['paid_amount'],
            'balance' => $data['balance'],
            'issue_date' => $data['issue_date'],
            'due_date' => $data['due_date'],
            'status' => $data['status'],
            'notes' => $data['notes'],
        ]);
    }
}
