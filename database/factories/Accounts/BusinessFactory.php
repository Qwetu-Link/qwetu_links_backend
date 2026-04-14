<?php

namespace Database\Factories\Accounts;

use App\Models\accounts\Business;
use App\Models\accounts\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Business>
 */
class BusinessFactory extends Factory
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
            'name' => fake()->company(),
            'slug' => fake()->slug(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'website' => fake()->url(),
            'country' => fake()->country(),
            'city' => fake()->city(),
            'address' => fake()->address(),
            'logo_url' => fake()->imageUrl(50, 50, 'business', true),
            'bank_name' => fake()->randomElement([
                'Equity Bank',
                'KCB Bank',
                'Co-operative Bank',
                'Absa Bank',
                'NCBA Bank',
            ]),
            'bank_account_number' => fake()->bankAccountNumber(),
            'mpesa_paybill' => fake()->numerify('######'),
            'mpesa_account_number' => fake()->numerify('##########'),
            'mpesa_till_no' => fake()->numerify('#######'),
            'industry' => fake()->randomElement([
                'Technology',
                'Construction',
                'Hospitality',
                'Retail',
                'Finance',
                'Agriculture',
                'Real Estate',
            ]),
            'description' => fake()->sentence(2),
            'is_active' => fake()->boolean(),
            // 'owner_id' => User::factory()->state([
            //     'role' => 'owner',
            // ]),
        ];
    }
}
