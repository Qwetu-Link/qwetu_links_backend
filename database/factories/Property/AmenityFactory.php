<?php

namespace Database\Factories\Property;

use App\Models\accounts\Business;
use App\Models\property\Amenity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Amenity>
 */
class AmenityFactory extends Factory
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
            'name' => fake()->name(),
            'icon' => fake()->randomElement([
                'home',
                'building',
                'shop',
                'office',
                'warehouse',
                'hotel',
                'apartment',
            ]),

            'category' => fake()->randomElement([
                'Residential',
                'Commercial',
                'Industrial',
                'Mixed-use',
            ]),

            'description' => fake()->sentence(1),
            'business_id' => Business::inRandomOrder()->value('id'),
        ];
    }
}
