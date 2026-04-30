<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagerProfile extends Model
{
    protected $fillable = ['user_id', 'modules', 'status', 'notes'];

    protected $casts = ['modules' => 'array'];

    const MODULES = [
        'profiles'   => ['label' => 'User Profiles',  'icon' => 'fa-users',           'route' => 'admin.profiles.index'],
        'leads'      => ['label' => 'Leads',           'icon' => 'fa-bolt',            'route' => 'admin.leads'],
        'affiliate'  => ['label' => 'Affiliate',       'icon' => 'fa-share-nodes',     'route' => 'admin.affiliate'],
        'hierarchy'  => ['label' => 'Staff Hierarchy', 'icon' => 'fa-sitemap',         'route' => 'admin.hierarchy'],
        'blogs'      => ['label' => 'Blog',            'icon' => 'fa-pen-nib',         'route' => 'admin.blogs.index'],
        'categories' => ['label' => 'Categories',      'icon' => 'fa-tags',            'route' => 'admin.categories.index'],
        'locations'  => ['label' => 'Locations',       'icon' => 'fa-map-marked-alt',  'route' => 'admin.locations'],
        'services'   => ['label' => 'Services',        'icon' => 'fa-briefcase',       'route' => 'admin.services.index'],
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasModule(string $module): bool
    {
        return in_array($module, $this->modules ?? []);
    }

    public function firstModuleRoute(): string
    {
        foreach ($this->modules ?? [] as $module) {
            if (isset(self::MODULES[$module])) {
                return route(self::MODULES[$module]['route']);
            }
        }
        return route('frontend.home');
    }
}
