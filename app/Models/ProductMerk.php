<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMerk extends Model
{
    use HasFactory;

    public $table = 'product_merks';
    protected $fillable = [
        'store_id',
        'product_category_id',
        'name',
        'image',
        'is_active'
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
