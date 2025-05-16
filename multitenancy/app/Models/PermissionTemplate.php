<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionTemplate extends Model
{
    protected $fillable = ['name'];

    public function roles()
    {
        return $this->belongsToMany(RoleTemplate::class, 'permission_role_template');
    }
}
