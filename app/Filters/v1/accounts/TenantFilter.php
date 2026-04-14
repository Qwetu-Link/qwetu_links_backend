<?php

namespace App\Filters\v1\accounts;

use App\Filters\ApiFilter;

class TenantFilter extends ApiFilter
{
    protected $safeParams = [
        'userID' => ['eq', 'ne'],
        'unitNumber' => ['eq', 'ne'],
        'rentAmount' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'leaseStart' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'leaseEnd' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'nextOfKinName' => ['eq', 'ne'],
        'nextOfKinPhone' => ['eq', 'ne'],
        'isActive' => ['eq', 'ne'],
    ];

    // API uses different naming than the database
    protected $columnMap = [
        'userID' => 'user_id',
        'unitNumber' => 'unit_number',
        'rentAmount' => 'rent_amount',
        'leaseStart' => 'lease_start',
        'leaseEnd' => 'lease_end',
        'nextOfKinName' => 'next_of_kin_name',
        'nextOfKinPhone' => 'next_of_kin_phone',
        'isActive' => 'is_active',
    ];

    // protected $operatorMap = [
    //     'eq' => '=',
    //     'lt' => '<',
    //     'lte' => '<=',
    //     'gt' => '>',
    //     'gte' => '>=',
    //     'ne' => '!=',
    // ];
}
