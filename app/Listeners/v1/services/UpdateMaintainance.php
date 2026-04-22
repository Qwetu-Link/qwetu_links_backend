<?php

namespace App\Listeners\v1\services;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateMaintainance
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
        $maintainance = $event->maintainance;
        $data = $event->data;

        $maintainance->update([
            'unit_id' => $data['unit_id'],
            'title' => $data['title'],
            'issue' => $data['issue'],
            'priority' => $data['priority'],
            'status' => $data['status'],
            'reported_date' => $data['reported_date'],
            'resolved_date' => $data['resolved_date'],
            'cost' => $data['cost'],
            'notes' => $data['notes'],
        ]);
    }
}
