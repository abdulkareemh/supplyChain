<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Client extends Model
{
    use HasApiTokens,HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'product_list',
        'city',
        'regien',
        'street',
        'description',
        'status',
        
    ];

    protected $hidden = [
        'password',
        
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
