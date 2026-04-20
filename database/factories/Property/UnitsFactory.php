<?php

namespace Database\Factories\Property;

use App\Models\accounts\Business;
use App\Models\property\Property;
use App\Models\property\Units;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Units>
 */
class UnitsFactory extends Factory
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
            'unit_number' => 'U-'.fake()->unique()->numberBetween(1, 500),
            'unit_floor' => fake()->numberBetween(0, 20),
            'status' => fake()->randomElement([
                'available',
                'occupied',
                'reserved',
                'maintenance',
            ]),
            'rent_amount' => fake()->numberBetween(5000, 150000),
            'deposit_amount' => fake()->numberBetween(5000, 300000),
            'property_id' => Property::inRandomOrder()->value('id'),
            'business_id' => Business::inRandomOrder()->value('id'),
        ];
    }
}
