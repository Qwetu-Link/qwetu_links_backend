<?php

namespace App\Listeners\v1\property;

use App\Models\property\Units;

class CreateUnits
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
        $owner = $event->user;

        $units = Units::create([
            'unit_number' => $data['unit_number'],
            'unit_floor' => $data['unit_floor'],
            'status' => $data['status'],
            'rent_amount' => $data['rent_amount'],
            'deposit_amount' => $data['deposit_amount'],
            'property_id' => $data['property_id'],
            'business_id'=> $owner->business_id,
        ]);

        $event->units = $units;
    }
}
