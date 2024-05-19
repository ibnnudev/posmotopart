<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    const WAITING_PAYMENT      = 'waiting_payment'; // 2.  ketika stock disetujui masuk ke sini
    const WAITING_CONFIRMATION = 'waiting_confirmation'; // 3. ketika user sudah bayar masuk ke sini
    // const USER_CONFIRM         = 'user_confirm';
    const ADMIN_CONFIRM        = 'admin_confirm'; // 4. ketika admin sudah konfirmasi pembayaran oleh user
    // const ADMIN_REJECT         = 'admin_reject';
    // const USER_REJECT          = 'user_reject';
    const PROCESS_BY_MERCHANT  = 'process_by_merchant'; // 1. di cek stock oleh seller
    const SHIPPING             = 'shipping'; // 5. seller memproses barang / mengirim barang
    const DONE                 = 'done'; // 5. ketika barang sudah diterima user

    use HasFactory;
    public    $table    = 'transaction_details';
    protected $fillable = [
        'store_id',
        'transaction_code',
        'user_id',
        'qty', // total semua barang yang dibeli
        'total_price',
        'admin_fee',
        'status',
        'shipping_date',
        'destination_order_id', // null
        'payment_option_id',
        'payment_proof',  // null
        'confirm_date',  // null
        'receive_date',  // null
        'receive_proof',  // null
        'receive_by',  // null
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id', 'transaction_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function paymentOption()
    {
        return $this->belongsTo(PaymentOption::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function destinationOrder()
    {
        return $this->belongsTo(DestinationOrder::class, 'destination_order_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
