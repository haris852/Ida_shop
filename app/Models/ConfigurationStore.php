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

    public function isOpen()
    {
        $open_at = \Carbon\Carbon::parse($this->open_at);
        $close_at = \Carbon\Carbon::parse($this->close_at);
        $now = \Carbon\Carbon::now();

        if ($now->between($open_at, $close_at)) {
            return true;
        }

        return false;
    }
}
