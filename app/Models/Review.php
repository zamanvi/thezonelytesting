<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id', 'reviewer_id', 'reviewer_name',
        'rating', 'review', 'tags', 'reply', 'replied_at',
    ];

    protected $casts = ['replied_at' => 'datetime'];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
