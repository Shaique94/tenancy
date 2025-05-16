<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleTemplate extends Model
{
    protected $fillable = ['name'];

    public function permissions()
    {
        return $this->belongsToMany(PermissionTemplate::class, 'permission_role_template');
    }
}
