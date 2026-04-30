<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
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
