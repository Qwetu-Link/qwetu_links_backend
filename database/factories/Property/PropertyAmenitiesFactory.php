<?php

namespace Database\Factories\Property;

use App\Models\accounts\Business;
use App\Models\property\Amenity;
use App\Models\property\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PropertyAmenities>
 */
class PropertyAmenitiesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => bin2hex(random_bytes(6)),
            'amenity_id' => Amenity::inRandomOrder()->value('id'),
            'property_id' => Property::inRandomOrder()->value('id'),
            'business_id' => Business::inRandomOrder()->value('id'),
        ];
    }
}
