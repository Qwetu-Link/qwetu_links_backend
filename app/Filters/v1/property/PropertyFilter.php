<?php

namespace App\Filters\v1\property;

use App\Filters\ApiFilter;

class PropertyFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq', 'ne'],
        'slug' => ['eq', 'ne'],
        'address' => ['eq', 'ne'],
        'location' => ['eq', 'ne'],
        'apartment_type' => ['eq', 'ne'],
        'description' => ['eq', 'ne'],
        'bedrooms' => ['eq', 'ne'],
        'bathrooms' => ['eq', 'ne'],
        'square_meters' => ['eq', 'ne'],
        'businessID' => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'businessID' => 'business_id',
    ];
}
