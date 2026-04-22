<?php

namespace App\Models\services;

use App\Models\accounts\Tenant;
use App\Models\property\Units;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintainance extends Model
{
    /** @use HasFactory<\Database\Factories\Services\MaintainanceFactory> */
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'unit_id',
        'tenant_id',
        'title',
        'issue',
        'priority',
        'status',
        'reported_date',
        'resolved_date',
        'cost',
        'notes',
    ];

    protected $casts = [
        'reported_date' => 'date',
        'resolved_date' => 'date',
        'cost' => 'decimal:2',
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

    public function unit()
    {
        return $this->belongsTo(Units::class, 'unit_id');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function isResolved()
    {
        return $this->status === 'resolved';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }
}
