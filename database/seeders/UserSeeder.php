<?php

namespace Database\Seeders;

use App\Models\accounts\Business;
use App\Models\accounts\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $businesses = Business::all();

        foreach ($businesses as $business) {

            // Owner
            // User::factory()->create([
            //     'role' => 'owner',
            //     'business_id' => $business->id,
            // ]);

            // Staff users
            User::factory(1)->create([
                'role' => 'staff',
                'business_id' => $business->id,
            ]);

            // Tenant users
            User::factory(2)->create([
                'role' => 'tenant',
                'business_id' => $business->id,
            ]);
        }
    }
}
