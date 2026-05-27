<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id', 'name', 'price', 'description', 'image', 'gender'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function getImageAttribute($value)
    {
        if (!$value) {
            return null;
        }
        if (Str::startsWith($value, ['http://', 'https://'])) {
            return $value;
        }
        return asset('storage/' . $value);
    }
}