<?php

namespace App\Models\property;

use App\Models\accounts\Business;
use Database\Factories\Property\GalleryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    /** @use HasFactory<GalleryFactory> */
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'image_url',
        'property_id',
        'title',
        'description',
        'is_highlight',
        'business_id',
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

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    protected static function booted()
{
    static::deleting(function ($gallery) {
        if ($gallery->image_url && Storage::disk('public')->exists($gallery->image_url)) {
            Storage::disk('public')->delete($gallery->image_url);
        }
    });
}
}
