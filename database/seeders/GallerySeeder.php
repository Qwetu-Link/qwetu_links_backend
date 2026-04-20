<?php

namespace Database\Seeders;

use App\Models\property\Gallery;
use App\Models\property\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::all()->each(function ($property) {
            Gallery::factory()->count(rand(3, 8))->create([
                'property_id' => $property->id,
            ]);
        });
    }
}
