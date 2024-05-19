<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, HasRoles, SoftDeletes;

    const ADMIN = 'admin';
    const SELLER = 'seller';
    const BUYER = 'buyer';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'store_name',
        'card_number',
        'bank_name',
        'owner_name',
        // addtional information
        'province',
        'regency',
        'district',
        'zip_code',
        'address',
        'nik',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function store()
    {
        return $this->hasOne(Store::class);
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
        return $this->hasMany(ProductStockHistory::class, 'created_by', 'id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function customerTransactions()
    {
        return $this->hasMany(TransactionDetail::class, 'user_id');
    }
}
