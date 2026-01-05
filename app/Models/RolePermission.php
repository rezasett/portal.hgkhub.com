<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $fillable = [
        'role',
        'routes',
        'description',
    ];

    protected $casts = [
        'routes' => 'array',
    ];

    /**
     * Get routes for specific role
     */
    public static function getRoutesForRole($role)
    {
        $permission = self::where('role', $role)->first();
        return $permission ? $permission->routes : [];
    }

    /**
     * Update routes for specific role
     */
    public static function updateRoutesForRole($role, $routes, $description = null)
    {
        return self::updateOrCreate(
            ['role' => $role],
            [
                'routes' => $routes,
                'description' => $description
            ]
        );
    }
}