<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'email',
        'title',
        'phone',
        'designation',
        'whatsapp',
        'bio',
        'work_address',
        'status',
        'password',
        'about',
        'remark',
        'country',
        'state',
        'city',
        'zip_code',
        'slug',
        'business_name',
        'experience',
        'additional_details',
        'category_id',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
    public function educations()
    {
        return $this->hasMany(Education::class);
    }
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
    public function languages()
    {
        return $this->hasMany(Language::class);
    }
    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function category()
    {
        return parent::belongsTo(Category::class, 'category_id');
    }
}
