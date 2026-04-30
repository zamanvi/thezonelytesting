<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallLog extends Model
{
    protected $fillable = [
        'seller_id', 'lead_id', 'twilio_number',
        'caller_number', 'call_sid', 'status', 'duration', 'called_at',
    ];

    protected $casts = ['called_at' => 'datetime'];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
