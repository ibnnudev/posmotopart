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
}
