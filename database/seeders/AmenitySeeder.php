<?php

namespace Database\Seeders;

use App\Models\accounts\Business;
use App\Models\property\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = [
            'Swimming Pool',
            'Gym',
            'Parking',
            'Security',
            'Elevator',
            'WiFi',
            'Garden',
            'CCTV',
        ];

        foreach ($amenities as $name) {
            Amenity::create([
                'id' => bin2hex(random_bytes(6)),
                'name' => $name,
                'icon' => fake()->randomElement([
                    'pool', 'dumbbell', 'car', 'shield', 'elevator', 'wifi'
                ]),
                'category' => 'General',
                'description' => fake()->sentence(),
                'business_id' => Business::inRandomOrder()->value('id'),
            ]);
        }
    }
}
