<?php

namespace App\Listeners\v1\services;

class UpdateLease
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
        $lease = $event->lease;
        $data = $event->data;

        $lease->update([
            'unit_id' => $data['unit_id'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'rent_amount' => $data['rent_amount'],
            'deposit_amount' => $data['deposit_amount'],
            'next_due_date' => $data['next_due_date'],
            'grace_period_days' => $data['grace_period_days'],
            'late_fee' => $data['late_fee'],
            'notes' => $data['notes'],
            'status' => $data['status'],
        ]);
    }
}
