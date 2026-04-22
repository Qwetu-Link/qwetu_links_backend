<?php

namespace App\Filters\v1\finance;

use App\Filters\ApiFilter;

class PaymentFilter extends ApiFilter
{
    protected $safeParams = [
        'lease_id' => ['eq', 'ne'],
        'amount' => ['eq', 'ne'],
        'payment_date' => ['eq', 'ne'],
        'payment_method' => ['eq', 'ne'],
        'transaction_code' => ['eq', 'ne'],
        'type' => ['eq', 'ne'],
        'notes' => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'leaseID' => 'lease_id',
        'paymentDate' => 'payment_date',
        'paymentMethod' => 'payment_method',
        'transactionCode' => 'transaction_code',
    ];
}
