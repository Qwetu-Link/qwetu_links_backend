<?php

namespace Database\Seeders;

use App\Models\property\Property;
use App\Models\property\PropertyAmenities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyAmenitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::all()->each(function ($property) {
            $amenities = PropertyAmenities::inRandomOrder()
                ->take(rand(2, 6))
                ->pluck('id')
                ->toArray();

            $property->amenities()->sync($amenities);
        });
    }
}
