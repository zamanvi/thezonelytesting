<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwilioNumber extends Model
{
    protected $fillable = ['number', 'friendly_name', 'seller_id', 'assigned_at', 'status', 'twilio_sid'];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available')->whereNull('seller_id');
    }

    public function scopeAssigned($query)
    {
        return $query->where('status', 'assigned')->whereNotNull('seller_id');
    }

    public function assign(int $sellerId): void
    {
        $this->update([
            'seller_id'   => $sellerId,
            'status'      => 'assigned',
            'assigned_at' => now(),
        ]);
    }

    public function release(): void
    {
        $this->update([
            'seller_id'   => null,
            'status'      => 'available',
            'assigned_at' => null,
        ]);
    }
}
