<?php

namespace App\Listeners\v1\property;

use App\Models\property\Gallery;
use App\Models\property\Property;
use App\Models\property\PropertyAmenities;

class PropertyCreated
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

        $property = Property::create([
            'business_id' => $owner->business_id,
            'name' => $data['name'],
            'address' => $data['address'],
            'location' => $data['location'],
            'apartment_type' => $data['apartment_type'],
            'description' => $data['description'],
            'bedrooms' => $data['bedrooms'],
            'bathrooms' => $data['bathrooms'],
            'square_meters' => $data['square_meters'],
        ]);

        if (!empty($data['amenity_id'])) {
            $property->amenities()->sync($data['amenity_id']  ?? []);
        }

        // $imagePath = null;

        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('gallery', 'public');
        // }

        foreach ($data->file('images') as $index => $file) {
            $path = $file->store('gallery', 'public');

            Gallery::create([
                'image_url'   => $path,
                'property_id' => $property->id,
                'title'       => $data['title'][$index] ?? null,
                'description' => $data['description'][$index] ?? null,
                'is_highlight'=> $data['is_highlight'][$index] ?? 0,
                'business_id' => $owner->business_id,
            ]);
        }

        $event->property = $property;
    }
}
