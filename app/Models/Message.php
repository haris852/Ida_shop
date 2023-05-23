<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $table = 'messages';
    protected $fillable = [
        'name',
        'from',
        'to',
        'message',
        'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'from', 'id');
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'to', 'id');
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', 0);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', 1);
    }

    public function scopeUnreadCount($query)
    {
        return $query->where('is_read', 0)->count();
    }

    public function scopeReadCount($query)
    {
        return $query->where('is_read', 1)->count();
    }
}
