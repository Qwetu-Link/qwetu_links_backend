<?php

namespace App\Listeners\v1\accounts;

use App\Events\v1\accounts\BusinessCreated;
use App\Models\accounts\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Hash;

class CreateBusinessOwnerUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BusinessCreated $event): void
    {
        $business = $event->business;
        $password = $event->password;

        User::create([
            'business_id' => $business->id,
            'name' => $business->name,
            'username' => $business->name,
            'email' => $business->email,
            'phone' => $business->phone,
            'address' => $business->address,
            'role' => 'owner',
            'password' => Hash::make($password),
            'is_active' => 1,
        ]);
    }
}
