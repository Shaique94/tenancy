<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'tenant_id'];

    public function tenant()
    {
        return $this->belongsTo(\App\Models\Tenant::class);
    }
}
