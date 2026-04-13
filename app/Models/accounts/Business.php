<?php

namespace App\Models\accounts;

use Database\Factories\Accounts\BusinessFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    /** @use HasFactory<BusinessFactory> */
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'website',
        'country',
        'city',
        'address',
        'logo_url',
        'bank_name',
        'bank_account_number',
        'mpesa_paybill',
        'mpesa_account_number',
        'mpesa_till_no',
        'industry',
        'description',
        'is_active',
        'owner_id',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
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
}
