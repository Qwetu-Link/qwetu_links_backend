<?php

namespace App\Models\accounts;

use Database\Factories\Accounts\TenantFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    /** @use HasFactory<TenantFactory> */
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'unit_number',
        'rent_amount',
        'lease_start',
        'lease_end',
        'next_of_kin_name',
        'next_of_kin_phone',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'lease_start' => 'date',
            'lease_end' => 'date',
            'rent_amount' => 'decimal:2',
        ];
    }

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
