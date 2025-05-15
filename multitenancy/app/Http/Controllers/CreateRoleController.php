<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class CreateRoleController extends Controller
{
    public function createRole(Request $request){

        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Role::create([
            'name' => $request->name,
            'tenant_id' => tenant()->id, // Provided by stancl/tenancy
        ]);

        return back()->with('success', 'Role created successfully!');


        
    }
}
