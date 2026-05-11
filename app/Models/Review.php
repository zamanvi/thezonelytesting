<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'seller_id', 'lead_id', 'reviewer_id', 'reviewer_name', 'reviewer_email',
        'rating', 'review', 'tags', 'reply', 'replied_at',
        'review_token', 'token_used_at',
    ];

    protected $casts = [
        'replied_at'    => 'datetime',
        'token_used_at' => 'datetime',
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    /** True once the buyer has actually submitted their rating */
    public function isSubmitted(): bool
    {
        return !is_null($this->rating);
    }
}
