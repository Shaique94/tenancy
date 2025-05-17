<?php

namespace App\Livewire\Tenant;

use App\Models\Tenant;
use Livewire\Component;

class CreateTenant extends Component
{

    public string $name = '';
    public string $id = '';
    public string $domain = '';

    public function createTenant()
    {
        // dd($this->name, $this->id, $this->domain);
        $this->validate([
            'name' => 'required|string|max:255',
            'id' => 'required|string|alpha_dash|unique:tenants,id',
            'domain' => 'required|string|regex:/^[a-z0-9\-\.]+$/|unique:domains,domain',
        ]);
                // dd($this->name, $this->id, $this->domain);
                // dd([
                //     'id' => $this->id,
                //     'data' => ['name' => $this->name],
                // ]);

        // Step 1: Create the tenant (with short id)
        $tenant = Tenant::create([
            'id' => $this->id,
            'name' => $this->name,
        ]);
        // 'id' => 'tenant9',
        //     'name' => 'Tenant 7',

        // dd($tenant->getAttributes());


        // Step 2: Attach domain to the tenant
        $tenant->domains()->create([
            'domain' => $this->domain, // e.g. tenant1.localhost
        ]);

        // Step 3: Initialize tenancy context
        tenancy()->initialize($tenant);

        // // Step 4: Create default roles and admin user
        // Role::create(['name' => 'Admin']);
        // Role::create(['name' => 'Staff']);

        // $admin = User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@' . $this->domain,
        //     'password' => Hash::make('password'),
        // ]);
        // $admin->assignRole('Admin');

        tenancy()->end();
        // dd($tenant);

        session()->flash('message', 'Tenant created successfully with domain mapping.');
        $this->reset();
    }
    public function render()
    {
        return view('livewire.tenant.create-tenant');
    }
}
