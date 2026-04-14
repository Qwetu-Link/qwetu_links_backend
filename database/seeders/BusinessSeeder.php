<?php

namespace Database\Seeders;

use App\Models\accounts\Business;
use App\Models\accounts\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Business::factory(1)->create()->each(function ($business) {

            // Owner
            $owner = User::factory()->create([
                'role' => 'owner',
                'business_id' => $business->id,
            ]);
        });
    }
}
