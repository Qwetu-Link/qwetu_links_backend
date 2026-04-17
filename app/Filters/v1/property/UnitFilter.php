<?php

namespace App\Filters\v1\property;

use App\Filters\ApiFilter;

class UnitFilter extends ApiFilter
{
    protected $safeParams = [
        'unitNumber' => ['eq', 'ne'],
        'unitFloor' => ['eq', 'ne'],
        'status' => ['eq', 'ne'],
        'rentAmount' => ['eq', 'ne'],
        'depositAmount' => ['eq', 'ne'],
        'businessID' => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'businessID' => 'business_id',
        'depositAmount' => 'deposit_amount',
        'rentAmount' => 'rent_amount',
        'unitFloor' => 'unit_floor',
        'unitNumber' => 'unit_number',
    ];
}