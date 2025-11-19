<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    
    protected $fillable = ['payment_date', 'amount', 'method', 'reference_number', 'status', 'policy_id'];
    
    // A Payment belongs to a Policy
    public function policy()
    {
        return $this->belongsTo(Policy::class);
    }
}
