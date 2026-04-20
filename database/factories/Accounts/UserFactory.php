<?php

namespace Database\Factories\Accounts;

use App\Models\accounts\Business;
use App\Models\accounts\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => bin2hex(random_bytes(6)),
            'business_id' => Business::factory(),
            'role' => fake()->randomElement([
                'owner',
                'tenant',
                'staff',
            ]),
            'username' => fake()->unique()->name(),
            'phone' => fake()->phoneNumber(),
            'emergency_contact_name' => fake()->name(),
            'emergency_contact_phone' => fake()->phoneNumber(),
            'emergency_contact_relationship' => fake()->randomElement([
                'mother',
                'father',
                'guardian',
                'sibling',
            ]),
            'id_number' => fake()->numerify('#######'),
            'address' => fake()->address(),
            'avatar' => fake()->imageUrl(50, 50, 'people', true),
            'is_active' => fake()->boolean(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
