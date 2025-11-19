<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'vin', 'registration_number', 'brand', 'model', 'manufacture_year', 'color', 'owner_name', 'owner_phone', 'owner_email', 'address', 'aproximate_min', 'aproximate_max'];

     // A Vehicle has many Policies
    public function policies()
    {
        return $this->hasMany(Policy::class);
    }

}
