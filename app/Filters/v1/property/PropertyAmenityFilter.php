<?php

namespace App\Filters\v1\property;

use App\Filters\ApiFilter;

class PropertyAmenityFilter extends ApiFilter
{
    protected $safeParams = [
        'amenityID' => ['eq', 'ne'],
        'propertyID' => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'amenityID' => 'amenity_id',
        'propertyID' => 'property_id',
    ];
}