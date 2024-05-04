<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentOption extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'payment_options';

    protected $fillable = [
        'name',
        'description',
        'status',
        'admin_fee',
        'duration',
    ];
}
