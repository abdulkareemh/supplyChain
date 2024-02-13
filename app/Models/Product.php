<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'category_id',
        'supplier_id',
        'price',
        // 'unit',
        // '',
    ];

    protected $hidden = [
        

    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Images::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id');
    }

    public function getCategoryIdAttribute()
    {
        try {
            return Category::where('id', $this->id)->first()->name;
        } catch (Exception $e) {
            return null;
        }
    }

    // public function getSupplierIdAttribute()
    // {
    //     try {
    //         return Supplier::where('id', $this->id)->first()->name;
    //     } catch (Exception $e) {
    //         return null;
    //     }
    // }
    
}
