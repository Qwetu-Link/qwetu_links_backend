<?php

namespace App\Models\property;

use App\Models\services\Lease;
use App\Models\services\Maintainance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    /** @use HasFactory<\Database\Factories\Property\UnitsFactory> */
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'unit_number',
        'unit_floor',
        'status',
        'rent_amount',
        'deposit_amount',
        'property_id'
    ];

    protected function casts(): array
    {
        return [
            'rent_amount' => 'decimal:2',
            'deposit_amount' => 'decimal:2',
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

    public function leases()
    {
        return $this->hasMany(Lease::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function maintainance()
    {
        return $this->hasMany(Maintainance::class);
    }
}
