<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ADMIN_ROLE = 'admin';
    const USER_ROLE = 'user';

    protected $fillable = [
        'name',
        'sex',
        'phone',
        'address',
        'avatar',
        'email',
        'password',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id', 'id');
    }

    public function transaction_details()
    {
        return $this->hasMany(TransactionDetail::class, 'user_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'user_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'from', 'id');
    }

    public function messagesTo()
    {
        return $this->hasMany(Message::class, 'to', 'id');
    }

    // scope is_active = true
    public function scopeActive()
    {
        return $this->where('is_active', true);
    }
}
