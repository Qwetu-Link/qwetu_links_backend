<?php

namespace Database\Factories\Accounts;

use App\Models\accounts\Tenant;
use App\Models\accounts\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->regexify('[A-F0-9]{12}'),
            'user_id' => User::factory()->state([
                'role' => 'tenant',
            ]),
            'unit_number' => fake()->bothify('A-###'),
            'rent_amount' => fake()->numberBetween(5000, 50000),
            'lease_start' => fake()->dateTimeBetween('-1 year', 'now'),
            'lease_end' => fake()->dateTimeBetween('now', '+1 year'),
            'next_of_kin_name' => fake()->name(),
            'next_of_kin_phone' => fake()->phoneNumber(),
            'is_active' => fake()->boolean(),
        ];
    }
}
