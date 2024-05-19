<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestProduct extends Model
{

    const STATUS_PENDING = 'menunggu';
    const STATUS_ACCEPTED = 'diterima';
    const STATUS_REJECTED = 'ditolak';

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
        'product_merk_id',
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

    public function productMerk()
    {
        return $this->belongsTo(ProductMerk::class);
    }
}
