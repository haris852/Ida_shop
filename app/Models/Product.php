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
}
