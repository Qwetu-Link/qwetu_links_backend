<?php

namespace Database\Factories\Property;

use App\Models\accounts\Business;
use App\Models\property\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Property>
 */
class PropertyFactory extends Factory
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
            'name' => fake()->company().' Apartments',
            'slug' => Str::slug(fake()->company().'-apartments'),
            'address' => fake()->streetAddress(),
            'location' => fake()->city().', '.fake()->country(),
            'apartment_type' => fake()->randomElement([
                'Studio',
                '1 Bedroom',
                '2 Bedroom',
                '3 Bedroom',
                'Penthouse',
            ]),
            'description' => fake()->paragraph(3),
            'bedrooms' => fake()->numberBetween(0, 5),
            'bathrooms' => fake()->numberBetween(1, 4),
            'square_meters' => fake()->numberBetween(30, 300),
            'business_id' => Business::inRandomOrder()->value('id'),
        ];
    }
}
