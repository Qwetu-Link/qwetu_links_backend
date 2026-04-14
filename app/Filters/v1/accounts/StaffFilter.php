<?php

namespace App\Filters\v1\accounts;

use App\Filters\ApiFilter;

class StaffFilter extends ApiFilter
{
    protected $safeParams = [
        'userID' => ['eq', 'ne'],
        'position' => ['eq', 'ne'],
        'department' => ['eq', 'ne'],
        'salary' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'hireDate' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'employmentType' => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'userID' => 'user_id',
        'hireDate' => 'hire_date',
        'employmentType' => 'employment_type',
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
