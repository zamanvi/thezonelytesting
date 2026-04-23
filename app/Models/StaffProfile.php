<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffProfile extends Model
{
    protected $fillable = [
        'user_id', 'role', 'parent_id', 'assigned_area', 'assigned_state',
        'base_salary', 'commission_rate', 'status', 'joined_at', 'notes',
        'sellers_onboarded', 'active_sellers', 'dispute_rate', 'revenue_generated',
    ];

    protected $casts = [
        'joined_at'          => 'date',
        'base_salary'        => 'decimal:2',
        'commission_rate'    => 'decimal:2',
        'dispute_rate'       => 'decimal:2',
        'revenue_generated'  => 'decimal:2',
    ];

    const ROLES = [
        'area_manager'     => 'Area Manager',
        'city_manager'     => 'City Manager',
        'district_manager' => 'District Manager',
        'country_manager'  => 'Country Manager',
    ];

    const ROLE_SALARY = [
        'area_manager'     => ['min' => 300,  'max' => 600],
        'city_manager'     => ['min' => 800,  'max' => 1500],
        'district_manager' => ['min' => 1800, 'max' => 3000],
        'country_manager'  => ['min' => 4000, 'max' => 7000],
    ];

    const ROLE_COMMISSION = [
        'area_manager'     => '5–10% per lead',
        'city_manager'     => '2–4% revenue override',
        'district_manager' => '1–2% revenue share',
        'country_manager'  => '0.5–1.5% revenue share',
    ];

    const ROLE_REPORTS_TO = [
        'area_manager'     => 'city_manager',
        'city_manager'     => 'district_manager',
        'district_manager' => 'country_manager',
        'country_manager'  => null,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(StaffProfile::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(StaffProfile::class, 'parent_id');
    }

    public function getRoleLabelAttribute()
    {
        return self::ROLES[$this->role] ?? $this->role;
    }
}
