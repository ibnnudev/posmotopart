<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestProduct extends Model
{
    use HasFactory, UUID, HasUuids;

    public $table = 'request_products';
    protected $fillable = [
        'store_id',
        'user_id',
        'file',
        'status',
        'feedback',
        'reviewed_by',
        'product_category_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewedBy()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
