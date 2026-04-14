<?php

namespace Database\Seeders;

use App\Models\accounts\Tenant;
use App\Models\accounts\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenantUsers = User::where('role', 'tenant')->get();

        foreach ($tenantUsers as $user) {
            Tenant::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
