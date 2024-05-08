<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, UUID, HasUuids;

    public $table = 'products';
    protected $fillable = [
        'SKU',
        'SKU_seller',
        'name',
        'stock',
        'size',
        'unit',
        'price',
        'discount',
        'type',
        'machine_name',
        'SAE',
        'manufacturer',
        'store_id',
        'user_id',
        'merk'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function stockHistories()
    {
        return $this->hasMany(ProductStockHistory::class, 'product_id', 'id');
    }
}
