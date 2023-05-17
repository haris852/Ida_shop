<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const STATUS_PENDING    = 'PENDING';
    const STATUS_CONFIRMED  = 'CONFIRMED';
    const STATUS_PAID       = 'PAID';
    const STATUS_FAILED     = 'FAILED';
    const STATUS_DELIVERED  = 'DELIVERED';
    const STATUS_SUCCESS    = 'SUCCESS';

    public $table = 'transactions';
    protected $fillable = [
        'transaction_code',
        'receiver_name',
        'receiver_phone',
        'receiver_address',
        'note',
        'proof_of_payment',
        'status',
        'is_confirmed',
        'user_id',
        'payment_method',
        'total_price',
        'shipping_price',
        'total_payment',
        'created_by',
        'updated_by',
    ];

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function generateTransactionCode()
    {
        // prefix TRX-2021-0001
        $prefix = 'TRX-' . date('Y') . '-';
        $lastTransaction = $this->orderBy('id', 'desc')->first();

        if (! $lastTransaction) {
            return $prefix . '0001';
        }

        $lastCode = substr($lastTransaction->transaction_code, -4);
        $newCode = (int) $lastCode + 1;

        return $prefix . sprintf('%04s', $newCode);
    }
}
