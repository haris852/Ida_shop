<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $table = 'products';
    protected $fillable = [
        'image',
        'category',
        'name',
        'weight',
        'description',
        'stock',
        'price',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
