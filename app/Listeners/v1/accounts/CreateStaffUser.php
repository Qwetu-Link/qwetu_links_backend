<?php

namespace App\Listeners\v1\accounts;

use App\Events\v1\accounts\StaffCreated;
use App\Mail\UserVerifyMail;
use App\Models\accounts\Business;
use App\Models\accounts\Staff;
use App\Models\accounts\User;
use App\Models\email\EmailVerification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CreateStaffUser
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
    public function handle(StaffCreated $event): void
    {
        $owner = $event->user;
        $data = $event->data;

        $user = User::create([
            'business_id' => $owner->business_id,
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'staff',
            'phone' => $data['phone'],
            'emergency_contact_name' => $data['emergency_contact_name'],
            'emergency_contact_phone' => $data['emergency_contact_phone'],
            'emergency_contact_relationship' => $data['emergency_contact_relationship'],
            'id_number' => $data['id_number'],
            'address' => $data['address'],
            'avatar' => $data['avatar'],
            'is_active' => true,
        ]);

        $staff = Staff::create([
            'user_id' => $user->id,
            'position' => $data['position'],
            'department' => $data['department'],
            'salary' => $data['salary'],
            'hire_date' => $data['hire_date'],
            'employment_type' => $data['employment_type'],
            'business_id' => $owner->business_id,
        ]);

        $event->staff = $staff;

        $business = Business::findOrFail($owner->business_id);

        $record = EmailVerification::create([
            'business' => $business->name,
            'role' => 'Staff',
            'user_id' => $user->id,
            'email' => $user->email,
            'token' => Str::random(64),
            'expires_at' => Carbon::now()->addHours(24),
        ]);

        Mail::to($user->email)->send(new UserVerifyMail($record));
    }
}
