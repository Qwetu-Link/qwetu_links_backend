<?php

namespace App\Filters\v1\accounts;

use App\Filters\ApiFilter;

class UserFilter extends ApiFilter
{
    protected $safeParams = [
        'businessID' => ['eq', 'ne'],
        'name' => ['eq', 'ne'],
        'email' => ['eq', 'ne'],
        'role' => ['eq', 'ne'],
        'phone' => ['eq', 'ne'],
        'emergencyContactName' => ['eq', 'ne'],
        'emergencyContactPhone' => ['eq', 'ne'],
        'emergencyContactRelationship' => ['eq', 'ne'],
        'idNumber' => ['eq', 'ne'],
        'address' => ['eq', 'ne'],
        'isActive' => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'businessID' => 'business_id',
        'emergencyContactName' => 'emergency_contact_name',
        'emergencyContactPhone' => 'emergency_contact_phone',
        'emergencyContactRelationship' => 'emergency_contact_relationship',
        'idNumber' => 'id_number',
        'isActive' => 'is_active',
    ];

    // protected $operatorMap = [
    //     'eq' => '=',
    //     'lt' => '<',
    //     'lte' => '<=',
    //     'gt' => '>',
    //     'gte' => '>=',
    //     'ne' => '!=',
    //     'like' => 'LIKE',
    //     'in' => 'IN',
    // ];
}
