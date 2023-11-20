<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
        'referral_code',
        'mobile',
        'referred_by',
        'level',
        'wallet',
        'tax_amount',
        'bank_name',
        'account_number',
        'ifsc',
        'branch_name'
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
        'password' => 'hashed',
    ];

    public function epin(): HasMany
    {
        return $this->hasMany(Epin::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin'; // Replace 'admin' with your actual role check logic.
    }

    public function transactionHistory(): HasMany
    {
        return $this->hasMany(TransactionHistory::class);
    }

    public function withdrawl(): HasMany
    {
        return $this->hasMany(WithdrawlHistory::class);
    }
}
