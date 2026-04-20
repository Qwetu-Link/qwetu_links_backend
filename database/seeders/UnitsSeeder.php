<?php

namespace Database\Seeders;

use App\Models\property\Property;
use App\Models\property\Units;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::all()->each(function ($property) {
            Units::factory()->count(rand(3, 10))->create([
                'property_id' => $property->id,
            ]);
        });
    }
}
