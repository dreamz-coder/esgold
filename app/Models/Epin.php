<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Epin extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'epin',
        'is_used'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Transfer(): HasMany
    {
        return $this->hasMany(Transfer::class);
    }
}
