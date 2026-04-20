<?php

namespace Database\Factories\Property;

use App\Models\accounts\Business;
use App\Models\Property;
use App\Models\property\Gallery;
use App\Models\property\Property as ModelsProperty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Gallery>
 */
class GalleryFactory extends Factory
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
            'image_url' => fake()->imageUrl(640, 480, 'real estate', true),
            'property_id' => ModelsProperty::inRandomOrder()->value('id'),
            'title' => fake()->randomElement([
                'Living Room',
                'Kitchen View',
                'Bedroom',
                'Bathroom',
                'Exterior View',
                'Balcony',
                'Parking Area',
            ]),
            'description' => fake()->sentence(1),
            'is_highlight' => fake()->boolean(20), // 20% chance true
            'business_id' => Business::inRandomOrder()->value('id'),
        ];
    }
}
