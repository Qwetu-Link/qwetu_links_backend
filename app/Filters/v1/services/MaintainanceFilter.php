<?php

namespace App\Filters\v1\services;

use App\Filters\ApiFilter;

class MaintainanceFilter extends ApiFilter
{
    protected $safeParams = [
        'unit_id' => ['eq', 'ne'],
        'tenant_id' => ['eq', 'ne'],
        'title' => ['eq', 'ne'],
        'issue' => ['eq', 'ne'],
        'priority' => ['eq', 'ne'],
        'status' => ['eq', 'ne'],
        'reported_date' => ['eq', 'ne', 'gt', 'gte', 'lt', 'lte'],
        'resolved_date' => ['eq', 'ne', 'gt', 'gte', 'lt', 'lte'],
        'cost' => ['eq', 'ne', 'gt', 'gte', 'lt', 'lte'],
        'notes' => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'unitID' => 'unit_id',
        'tenantID' => 'tenant_id',
        'reportedDate' => 'reported_date',
        'resolvedDate' => 'resolved_date',
    ];
}
