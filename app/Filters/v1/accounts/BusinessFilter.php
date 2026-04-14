<?php

namespace App\Filters\v1\accounts;

use App\Filters\ApiFilter;

class BusinessFilter extends ApiFilter
{
    // eq->Equal To, gt->Greater Than , lt-> Less Than

    protected $safeParams = [
        'name' => ['eq', 'ne'],
        'slug' => ['eq', 'ne'],
        'email' => ['eq', 'ne'],
        'phone' => ['eq', 'ne'],
        'website' => ['eq', 'ne'],
        'country' => ['eq', 'ne'],
        'city' => ['eq', 'ne'],
        'address' => ['eq', 'ne'],
        'bankName' => ['eq', 'ne'],
        'bankAccountNumber' => ['eq', 'ne'],
        'mpesaPaybill' => ['eq', 'ne'],
        'mpesaAccountNumber' => ['eq', 'ne'],
        'mpesaTillNo' => ['eq', 'ne'],
        'industry' => ['eq', 'ne'],
        'isActive' => ['eq', 'ne'],
    ];

    // API uses different naming than the database
    protected $columnMap = [
        'bankName' => 'bank_name',
        'bankAccountNumber' => 'bank_account_number',
        'mpesaPaybill' => 'mpesa_paybill',
        'mpesaAccountNumber' => 'mpesa_account_number',
        'mpesaTillNo' => 'mpesa_till_no',
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
