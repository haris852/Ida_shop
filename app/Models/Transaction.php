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
        'proof_of_receipt',
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

    public function review()
    {
        return $this->hasOne(Review::class, 'transaction_id', 'id');
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

    public function getTotalSales()
    {
        return $this->where('status', self::STATUS_SUCCESS)->sum('total_payment');
    }

    public function getTotalSalesDaily()
    {
        return $this->where('status', self::STATUS_SUCCESS)->whereDate('created_at', date('Y-m-d'))->sum('total_payment');
    }

    public function getTotalSalesDifference()
    {
        $today = $this->getTotalSalesDaily();
        $yesterday = $this->where('status', self::STATUS_SUCCESS)->whereDate('created_at', date('Y-m-d', strtotime('-1 day')))->sum('total_payment');

        // return if up or down and percentage, fix if yesterday is 0
        if ($yesterday == 0) {
            return [
                'is_up' => true,
                'percentage' => 100,
            ];
        }

        $percentage = (($today - $yesterday) / $yesterday) * 100;

        return [
            'is_up' => $percentage > 0,
            'percentage' => abs($percentage) > 100 ? 100 : abs($percentage),
        ];
    }

    public function getTotalCustomers()
    {
        return $this->where('status', self::STATUS_SUCCESS)->groupBy('user_id')->count();
    }

    public function getTotalCustomersDaily()
    {
        return $this->where('status', self::STATUS_SUCCESS)->whereDate('created_at', date('Y-m-d'))->groupBy('user_id')->count();
    }

    public function getTotalCustomersDifference()
    {
        $today = $this->getTotalCustomersDaily();
        $yesterday = $this->where('status', self::STATUS_SUCCESS)->whereDate('created_at', date('Y-m-d', strtotime('-1 day')))->groupBy('user_id')->count();

        // return if up or down and difference in number
        if ($today > $yesterday) {
            $difference = $today - $yesterday;
            $status = true;
        } else if ($today < $yesterday) {
            $difference = $yesterday - $today;
            $status = false;
        } else {
            $difference = 0;
            $status = true;
        }

        return [
            'is_up' => $status,
            'difference' => $difference,
        ];
    }
}
