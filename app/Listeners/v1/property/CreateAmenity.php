<?php

namespace App\Listeners\v1\property;

use App\Models\property\Amenity;

class CreateAmenity
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

        $amenity = Amenity::create([
            'name' => $data['name'],
            'icon' => $data['icon'],
            'category' => $data['category'],
            'description' => $data['description'],
            'business_id' => $owner->business_id
        ]);

        $event->amenity = $amenity;
    }
}
