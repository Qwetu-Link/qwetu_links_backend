<?php

namespace Database\Seeders;

use App\Models\accounts\Staff;
use App\Models\accounts\User;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staffUsers = User::where('role', 'staff')->get();

        foreach ($staffUsers as $user) {
            Staff::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
