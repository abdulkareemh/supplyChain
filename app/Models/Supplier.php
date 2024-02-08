<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Supplier extends Model
{
    use HasApiTokens,HasFactory;


    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'commercial_register_number',
        'commercial_register_image',
        'company_image',
        'category',
    ];


    protected $hidden = [
        'password',
        
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function serviceAreas(): HasMany
    {
        return $this->hasMany(ServiceArea::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
