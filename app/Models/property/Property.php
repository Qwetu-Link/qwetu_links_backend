<?php

namespace App\Models\property;

use App\Models\accounts\Business;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\Property\PropertyFactory> */
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'slug',
        'address',
        'location',
        'apartment_type',
        'description',
        'bedrooms',
        'bathrooms',
        'square_meters',
        'business_id',
    ];

    protected function casts(): array
    {
        return [
            
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

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function units()
    {
        return $this->hasMany(Units::class);
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }

    public function amenity()
    {
        return $this->belongsToMany(Gallery::class);
    }
}
