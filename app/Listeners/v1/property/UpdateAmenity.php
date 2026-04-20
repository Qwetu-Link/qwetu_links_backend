<?php

namespace App\Listeners\v1\property;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateAmenity
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
        $amenity = $event->amenity;

        $amenity->update([
            'name' => $data['name'],
            'icon' => $data['icon'],
            'category' => $data['category'],
            'description' => $data['description'],
        ]);
    }
}
