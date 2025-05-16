<?php

namespace App\Http\Controllers;

use App\Models\RoleTemplate;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class TenantRoleController extends Controller
{
    public function showForm()
    {
        // dd(auth()->user()->getAllPermissions()->pluck('name'));

        $templates = RoleTemplate::with('permissions')->get();
        return view('tenant.select-roles', compact('templates'));
    }

    public function store(Request $request)
{
    $request->validate([
        'roles' => 'required|array',
        'roles.*' => 'exists:role_templates,id',
    ]);

    $user = auth()->user(); // get logged-in tenant user

    $templates = RoleTemplate::with('permissions')->whereIn('id', $request->roles)->get();

    foreach ($templates as $template) {
        // Avoid duplicate role creation — add tenant_id uniqueness if needed
        $role = Role::firstOrCreate(
            ['name' => $template->name, 'guard_name' => 'web', 'tenant_id' => tenant('id')],
            ['created_at' => now(), 'updated_at' => now()]
        );

        foreach ($template->permissions as $permTemplate) {
            $permission = Permission::firstOrCreate(
                ['name' => $permTemplate->name, 'guard_name' => 'web', 'tenant_id' => tenant('id')],
                ['created_at' => now(), 'updated_at' => now()]
            );

            // Assign permission to role
            $role->givePermissionTo($permission);
        }

        // ✅ Assign role to current user
        if (!$user->hasRole($role->name)) {
            $user->assignRole($role);
        }
    }

    return redirect('/dashboard')->with('success', 'Roles and permissions assigned to you!');
}

}
