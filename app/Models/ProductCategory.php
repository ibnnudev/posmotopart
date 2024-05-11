<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    public $table = 'product_categories';
    protected $fillable = ['name', 'is_active'];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_category_id', 'id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_category_id', 'id');
    }
}
