<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'supply_id',
    ];
    public $timestamps = false;
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
