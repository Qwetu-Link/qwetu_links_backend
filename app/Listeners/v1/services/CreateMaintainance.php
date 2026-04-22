<?php

namespace App\Listeners\v1\services;

use App\Models\services\Maintainance;

class CreateMaintainance
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
    public function handle(object $event): void
    {
        $owner = $event->user;
        $data = $event->data;

        $tenant_id = $owner->tenant->id ?? null;

        $maintainance = Maintainance::create([
            'unit_id' => $data['unit_id'],
            'tenant_id' => $tenant_id,
            'title' => $data['title'],
            'issue' => $data['issue'],
            'priority' => $data['priority'],
            'status' => $data['status'],
            'reported_date' => $data['reported_date'],
            'resolved_date' => $data['resolved_date'],
            'cost' => $data['cost'],
            'notes' => $data['notes'],
            'business_id' => $owner->business_id,
        ]);

        $event->maintainance = $maintainance;
    }
}
