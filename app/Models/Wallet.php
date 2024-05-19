<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use HasFactory, SoftDeletes;

    public const WAITING = 0;
    public const APPROVED = 1;
    public const REJECTED = 2;

    public $table = 'wallets';
    protected $fillable = [
        'user_id',
        'balance',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
