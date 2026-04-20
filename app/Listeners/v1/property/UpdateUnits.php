<?php

namespace App\Listeners\v1\property;

class UpdateUnits
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
        $data = $event->data;
        $units = $event->units;

        $units->update([
            'unit_number' => $data['unit_number'],
            'unit_floor' => $data['unit_floor'],
            'status' => $data['status'],
            'rent_amount' => $data['rent_amount'],
            'deposit_amount' => $data['deposit_amount'],
        ]);
    }
}
