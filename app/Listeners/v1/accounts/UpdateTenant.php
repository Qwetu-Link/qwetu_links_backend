<?php

namespace App\Listeners\v1\accounts;

use App\Events\v1\accounts\TenantUpdate;
use App\Models\accounts\Tenant;

class UpdateTenant
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
    public function handle(TenantUpdate $event): void
    {
        $data = $event->data;
        $tenant = $event->tenant;

        $tenant->update([
            'next_of_kin_name' => $data['next_of_kin_name'],
            'next_of_kin_phone' => $data['next_of_kin_phone'],
        ]);

        $tenant->user->update([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'emergency_contact_name' => $data['emergency_contact_name'],
            'emergency_contact_phone' => $data['emergency_contact_phone'],
            'emergency_contact_relationship' => $data['emergency_contact_relationship'],
            'id_number' => $data['id_number'],
            'address' => $data['address'],
            'avatar' => $data['avatar'],
        ]);
    }
}
