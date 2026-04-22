<?php

namespace App\Models\finance;

use App\Models\services\Lease;
use Database\Factories\Services\PaymentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<PaymentFactory> */
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'lease_id',
        'invoice_id',
        'amount',
        'payment_date',
        'payment_method',
        'transaction_code',
        'type',
        'notes',
        'business_id',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'amount' => 'decimal:2',
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

    public function lease()
    {
        return $this->belongsTo(Lease::class);
    }

     public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
