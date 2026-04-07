<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model // this model is use as working zone
{
    use HasFactory;
    protected $fillable = ['name', 'start', 'end', 'address', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
