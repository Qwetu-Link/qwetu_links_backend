<?php

namespace App\Listeners\v1\property;

use App\Models\property\Gallery;
use App\Models\property\PropertyAmenities;

class PropertyUpdate
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
        $property = $event->property;

        $property->update([
            'name' => $data['name'],
            'address' => $data['address'],
            'location' => $data['location'],
            'apartment_type' => $data['apartment_type'],
            'description' => $data['description'],
            'bedrooms' => $data['bedrooms'],
            'bathrooms' => $data['bathrooms'],
            'square_meters' => $data['square_meters'],
        ]);

        Gallery::where('property_id', $property->id)->delete();
        PropertyAmenities::where('property_id', $property->id)->delete();

        if (!empty($data['amenity_id'])) {
            $property->amenities()->sync($data['amenity_id']  ?? []);
        }

        foreach ($data->file('images') as $index => $file) {
            $path = $file->store('gallery', 'public');

            Gallery::create([
                'image_url' => $path,
                'property_id' => $property->id,
                'title' => $data['title'][$index] ?? null,
                'description' => $data['description'][$index] ?? null,
                'is_highlight' => $data['is_highlight'][$index] ?? 0,
                'business_id' => $property->business_id,
            ]);
        }

    }
}
