<?php

namespace Database\Seeders;

use App\Models\property\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::factory()->count(5)->create()->each(function ($property) {
            $property->update([
                'slug' => Str::slug($property->name),
            ]);
        });
    }
}
