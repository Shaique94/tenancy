<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoleTemplate;
use App\Models\PermissionTemplate;

class RoleTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = RoleTemplate::create(['name' => 'Admin']);
        $receptionist = RoleTemplate::create(['name' => 'Receptionist']);
    
        $view = PermissionTemplate::create(['name' => 'view patients']);
        $create = PermissionTemplate::create(['name' => 'create appointments']);
    
        $admin->permissions()->attach([$view->id, $create->id]);
        $receptionist->permissions()->attach([$create->id]);
    }
}
