<?php

namespace Database\Factories\Accounts;

use App\Models\accounts\Staff;
use App\Models\accounts\User as AccountsUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Staff>
 */
class StaffFactory extends Factory
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
            'user_id' => AccountsUser::factory()->state([
                'role' => 'staff',
            ]),
            'position' => fake()->jobTitle(),
            'department' => fake()->randomElement([
                'Administration',
                'Finance',
                'IT',
                'HR',
                'Operations',
                'Sales',
                'Security',
            ]),
            'salary' => fake()->numberBetween(15000, 150000),
            'hire_date' => fake()->dateTimeBetween('-3 years', 'now'),
            'employment_type' => fake()->randomElement([
                'full-time',
                'part-time',
                'contract',
            ]),
        ];
    }
}
