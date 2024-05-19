<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationOrder extends Model
{
    use HasFactory;
    public $table = 'destination_orders';
    protected $fillable = [
        'user_id',
        'address',
        'latitude',
        'longitude',
        'is_default',
        'is_active',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
