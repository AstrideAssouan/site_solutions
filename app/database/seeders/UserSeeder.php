<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            'nom' => 'Super',
            'prenom' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123')
        ];
        
        $user = User::create($admin);
        $defaultRole = Role::where('nom_role', 'SUPER ADMIN')->first();
        
        if ($defaultRole) {
            $user->roles()->attach($defaultRole->id);
        }
        $permissions = Permission::all();
        $user->permissions()->attach($permissions->pluck('id'));
        
        
    }
}
