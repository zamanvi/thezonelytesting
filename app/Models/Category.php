<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'is_active', 'parent_id'];

    // Children categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Optional: Recursive children for multiple levels
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
