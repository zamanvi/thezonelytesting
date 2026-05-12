<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = ['user_id', 'name', 'issuer', 'issued_year', 'expiry_year', 'credential_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
