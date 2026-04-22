<?php

namespace App\Filters\v1\finance;

use App\Filters\ApiFilter;

class InvoiceFilter extends ApiFilter
{
    protected $safeParams = [
        'lease_id'       => ['eq', 'ne'],
        'tenant_id'      => ['eq', 'ne'],
        'invoice_number' => ['eq', 'ne'],
        'amount'         => ['eq', 'ne', 'gt', 'lt'],
        'paid_amount'    => ['eq', 'ne', 'gt', 'lt'],
        'balance'        => ['eq', 'ne', 'gt', 'lt'],
        'issue_date'     => ['eq', 'ne', 'gt', 'lt'],
        'due_date'       => ['eq', 'ne', 'gt', 'lt'],
        'status'         => ['eq', 'ne'],
        'notes'          => ['eq', 'ne'],
        'business_id'    => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'leaseID'       => 'lease_id',
        'tenantID'      => 'tenant_id',
        'invoiceNumber' => 'invoice_number',
        'paidAmount'    => 'paid_amount',
        'issueDate'     => 'issue_date',
        'dueDate'       => 'due_date',
        'businessID'    => 'business_id',
    ];
}