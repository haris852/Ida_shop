<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigurationStore extends Model
{
    use HasFactory;

    public $table = 'configuration_store';
    protected $fillable = [
        'code',
        'name',
        'address',
        'phone',
        'email',
        'open_at',
        'close_at',
        'shipping_cost',
        'is_active',
    ];
}
