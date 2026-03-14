<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'status', 'state_id'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function postalCodes()
    {
        return $this->hasMany(PostalCode::class);
    }
}
