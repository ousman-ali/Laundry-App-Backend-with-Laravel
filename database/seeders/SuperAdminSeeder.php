<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the user
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'), // 🔒 change this to a secure password
        ]);

        // Create the role if it doesn't exist
        $role = Role::firstOrCreate(['name' => 'super-admin']);

        // Get all permissions
        $permissions = Permission::all();

        // Give all permissions to the role
        $role->syncPermissions($permissions);

        // Assign role to user
        $superAdmin->assignRole($role);
    }
}
