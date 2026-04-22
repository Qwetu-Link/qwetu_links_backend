<?php

namespace App\Models\services;

use App\Models\accounts\Tenant;
use App\Models\finance\Payment;
use App\Models\property\Units;
use Database\Factories\Services\LeaseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    /** @use HasFactory<LeaseFactory> */
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'tenant_id',
        'unit_id',
        'start_date',
        'end_date',
        'rent_amount',
        'deposit_amount',
        'next_due_date',
        'grace_period_days',
        'late_fee',
        'notes',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'next_due_date' => 'date',
        'rent_amount' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'late_fee' => 'decimal:2',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = self::generateRandomID();
            }
        });
    }

    private static function generateRandomID()
    {
        return bin2hex(random_bytes(6));
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function unit()
    {
        return $this->belongsTo(Units::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    // Check if lease is active
    public function isActive()
    {
        return $this->status === 'active';
    }

    // Check if overdue
    public function isOverdue()
    {
        return now()->gt($this->next_due_date);
    }

    // Get total paid
    public function totalPaid()
    {
        return $this->payments()->sum('amount');
    }

    // Get balance
    public function balance()
    {
        return $this->rent_amount - $this->totalPaid();
    }
}
