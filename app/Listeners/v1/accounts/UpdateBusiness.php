<?php

namespace App\Listeners\v1\accounts;

use App\Events\v1\accounts\BusinessUpdate;

class UpdateBusiness
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
    public function handle(BusinessUpdate $event): void
    {
        $data = $event->data;
        $business = $event->business;

        $business->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'website' => $data['website'],
            'country' => $data['country'],
            'city' => $data['city'],
            'address' => $data['address'],
            'logo_url' => $data['logo_url'],
            'bank_name' => $data['bank_name'],
            'bank_account_number'=> $data['bank_account_number'],
            'mpesa_paybill' => $data['mpesa_paybill'],
            'mpesa_account_number' => $data['mpesa_account_number'],
            'mpesa_till_no' => $data['mpesa_till_no'],
            'industry' => $data['industry'],
            'description' => $data['description'],
        ]);

        $business->user->update([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'avatar' => $data['logo_url'],
            'address' => $data['address'],
        ]);
    }
}
