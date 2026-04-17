<?php

namespace App\Filters\v1\property;

use App\Filters\ApiFilter;

class AmenityFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq', 'ne'],
        'icon' => ['eq', 'ne'],
        'category' => ['eq', 'ne'],
        'description' => ['eq', 'ne'],
    ];
}