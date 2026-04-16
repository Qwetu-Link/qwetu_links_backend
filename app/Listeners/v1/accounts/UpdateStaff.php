<?php

namespace App\Listeners\v1\accounts;

use App\Events\v1\accounts\StaffUpdate;
use App\Models\accounts\Staff;
use App\Models\accounts\User;

class UpdateStaff
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
    public function handle(StaffUpdate $event): void
    {
        $staff = $event->staff;
        $data = $event->data;

        $staff->update([
            'position' => $data['position'],
            'department' => $data['department'],
            'salary' => $data['salary'],
            'hire_date' => $data['hire_date'],
            'employment_type' => $data['employment_type'],
        ]);

        $staff->user->update([
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
