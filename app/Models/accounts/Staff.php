<?php

namespace App\Models\accounts;

use Database\Factories\Accounts\StaffFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    /** @use HasFactory<StaffFactory> */
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'position',
        'department',
        'salary',
        'hire_date',
        'employment_type',
        'business_id',
    ];

    protected function casts(): array
    {
        return [
            'hire_date' => 'date',
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

    // public function getRouteKeyName()
    // {
    //     return 'id'; // or uuid
    // }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
