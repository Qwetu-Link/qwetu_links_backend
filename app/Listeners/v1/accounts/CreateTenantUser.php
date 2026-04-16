<?php

namespace App\Listeners\v1\accounts;

use App\Events\v1\accounts\TenantCreated;
use App\Models\accounts\Tenant;
use App\Models\accounts\User;

class CreateTenantUser
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
    public function handle(TenantCreated $event): void
    {
        $owner = $event->user;
        $data = $event->data;

        $user = User::create([
            'business_id' => $owner->business_id,
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'tenant',
            'phone' => $data['phone'],
            'emergency_contact_name' => $data['emergency_contact_name'],
            'emergency_contact_phone' => $data['emergency_contact_phone'],
            'emergency_contact_relationship' => $data['emergency_contact_relationship'],
            'id_number' => $data['id_number'],
            'address' => $data['address'],
            'avatar' => $data['avatar'],
            'is_active' => true,
        ]);

        // 2. Create tenant
        $tenant = Tenant::create([
            'user_id' => $user->id,
            'unit_number' => $data['unit_number'],
            'rent_amount' => $data['rent_amount'],
            'lease_start' => $data['lease_start'],
            'lease_end' => $data['lease_end'],
            'next_of_kin_name' => $data['next_of_kin_name'],
            'next_of_kin_phone' => $data['next_of_kin_phone'],
            'is_active' => true,
        ]);

        $event->tenant = $tenant;
        $event->user = $user;
    }
}
