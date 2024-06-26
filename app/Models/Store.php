<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    public $table = 'stores';
    protected $fillable = [
        'name',
        'slug',
        'user_id',
        'address',
        'phone',
        'logo',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requestProducts()
    {
        return $this->hasMany(RequestProduct::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productStockHistories()
    {
        return $this->hasMany(ProductStockHistory::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function discountStores()
    {
        return $this->hasMany(DiscountStore::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
