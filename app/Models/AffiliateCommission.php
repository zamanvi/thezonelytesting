<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AffiliateCommission extends Model
{
    use HasFactory;

    protected $fillable = ['referrer_id', 'referred_user_id', 'amount', 'status', 'paid_at', 'note'];

    protected $casts = ['paid_at' => 'datetime'];

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    public function referredUser()
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }

    public function scopePaid($query)   { return $query->where('status', 'paid'); }
    public function scopePending($query){ return $query->where('status', 'pending'); }
}
