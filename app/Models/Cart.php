<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // id isnot uuid
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_merk_id',
        'qty',
        'price',
        'discount_price',
        'total_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productMerk()
    {
        return $this->belongsTo(ProductMerk::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
