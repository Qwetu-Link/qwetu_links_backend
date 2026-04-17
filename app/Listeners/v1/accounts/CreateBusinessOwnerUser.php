<?php

namespace App\Listeners\v1\accounts;

use App\Events\v1\accounts\BusinessCreated;
use App\Mail\UserVerifyMail;
use App\Models\accounts\User;
use App\Models\email\EmailVerification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

        $user = User::create([
            'business_id' => $business->id,
            'name' => $business->name,
            'username' => $business->name,
            'email' => $business->email,
            'phone' => $business->phone,
            'address' => $business->address,
            'role' => 'owner',
            'password' => Hash::make($password),
            'is_active' => false,
        ]);

        $record = EmailVerification::create([
            'business' => $business->name,
            'role' => 'Business',
            'user_id' => $user->id,
            'email' => $user->email,
            'token' => Str::random(64),
            'expires_at' => Carbon::now()->addHours(24),
        ]);

        Mail::to($user->email)->send(new UserVerifyMail($record));
    }
}
