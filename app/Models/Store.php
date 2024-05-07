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
}
