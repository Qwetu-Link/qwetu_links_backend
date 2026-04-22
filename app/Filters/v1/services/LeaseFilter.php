<?php

namespace App\Filters\v1\services;

use App\Filters\ApiFilter;

class LeaseFilter extends ApiFilter
{
    protected $safeParams = [
        'tenant_id' => ['eq', 'ne'],
        'unit_id' => ['eq', 'ne'],
        'start_date' => ['eq', 'ne', 'gt', 'gte', 'lt', 'lte'],
        'end_date' => ['eq', 'ne', 'gt', 'gte', 'lt', 'lte'],
        'rent_amount' => ['eq', 'ne', 'gt', 'gte', 'lt', 'lte'],
        'deposit_amount' => ['eq', 'ne', 'gt', 'gte', 'lt', 'lte'],
        'next_due_date' => ['eq', 'ne', 'gt', 'gte', 'lt', 'lte'],
        'grace_period_days' => ['eq', 'ne'],
        'late_fee' => ['eq', 'ne', 'gt', 'gte', 'lt', 'lte'],
        'status' => ['eq', 'ne'],
        'notes' => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'tenantID' => 'tenant_id',
        'unitID' => 'unit_id',
        'startDate' => 'start_date',
        'endDate' => 'end_date',
        'rentAmount' => 'rent_amount',
        'depositAmount' => 'deposit_amount',
        'nextDueDate' => 'next_due_date',
        'gracePeriodDays' => 'grace_period_days',
        'lateFee' => 'late_fee',
    ];
}
