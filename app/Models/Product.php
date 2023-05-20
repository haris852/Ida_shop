<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // add global scope is active
    protected static function booted()
    {
        static::addGlobalScope('is_active', function ($query) {
            $query->where('is_active', 1);
        });
    }

    public $table = 'products';
    protected $fillable = [
        'image',
        'category',
        'name',
        'weight',
        'unit',
        'description',
        'stock',
        'price',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class, 'product_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }

    public function getTotalSalesByCategory()
    {
        return $this->with('transactionDetail')->get()->groupBy('category')->map(function ($item) {
            return $item->sum(function ($item) {
                return $item->transactionDetail->sum('qty');
            });
        });
    }

    public function getCategories()
    {
        return $this->select('category')->groupBy('category')->get();
    }
}
