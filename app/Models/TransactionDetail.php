<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    public $table = 'transaction_details';
    protected $fillable = [
        'transaction_id',
        'product_id',
        'qty',
        'price',
        'total_price',
        'created_by',
        'updated_by',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getTotalProductSales()
    {
        // check if transaction status is success and sum qty
        return $this->whereHas('transaction', function ($query) {
            $query->where('status', 'success');
        })->sum('qty');
    }

    public function getTotalProductSalesDaily()
    {
        // return $this->whereDate('created_at', date('Y-m-d'))->sum('qty');
        // check status is success and sum qty
        return $this->whereHas('transaction', function ($query) {
            $query->where('status', 'success');
        })->whereDate('created_at', date('Y-m-d'))->sum('qty');
    }

    public function getTotalProductSalesDifference()
    {
        // return is up or down and the mount
        $today = $this->getTotalProductSalesDaily();
        $yesterday = $this->whereDate('created_at', date('Y-m-d', strtotime('-1 day')))->sum('qty');

        if ($today > $yesterday) {
            $difference = $today - $yesterday;
            $status = true;
        } else if ($today < $yesterday) {
            $difference = $yesterday - $today;
            $status = true;
        } else {
            $difference = 0;
            $status = false;
        }

        return [
            'is_up' => $status,
            'difference' => $difference,
        ];
    }
}
