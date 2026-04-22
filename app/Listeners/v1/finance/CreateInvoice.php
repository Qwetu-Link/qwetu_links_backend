<?php

namespace App\Listeners\v1\finance;

use App\Models\finance\Invoice;

class CreateInvoice
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
        $user = $event->user;
        $data = $event->data;

        $tenant_id = $user->tenant->id ?? null;

        $invoice = Invoice::create([
            'lease_id' => $data['lease_id'],
            'tenant_id' => $tenant_id,
            // 'invoice_number',
            'amount' => $data['amount'],
            'paid_amount' => $data['paid_amount'],
            'balance' => $data['balance'],
            'issue_date' => $data['issue_date'],
            'due_date' => $data['due_date'],
            'status' => $data['status'],
            'notes' => $data['notes'],
            'business_id' => $user->business_id,
        ]);

        $event->invoice = $invoice;
    }
}
