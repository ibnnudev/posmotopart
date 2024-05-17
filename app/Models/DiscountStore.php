<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountStore extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'discount_stores';
    protected $fillable = [
        'discount_id',
        'store_id',
    ];

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
