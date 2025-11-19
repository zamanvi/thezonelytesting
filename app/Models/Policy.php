<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;
    protected $fillable = ['policy_number', 'insurance_company', 'policy_type', 'start_date', 'end_date', 'premium_amount', 'coverage_amount', 'deductible', 'status', 'notes', 'vehicle_id'];

    // A Policy belongs to a Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // A Policy has many Payments
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
