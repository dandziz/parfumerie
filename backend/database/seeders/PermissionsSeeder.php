<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'add perfumes', 'guard_name' => 'api']);
        $admin = Role::create(['name' => 'admin', 'guard_name' => 'api']);
        $manager = Role::create(['name' => 'manager', 'guard_name' => 'api']);
        $user = Role::create(['name' => 'user', 'guard_name' => 'api']);

        $adminUser = User::factory()->create([
            'name' => 'Local Admin',
            'email' => 'localadmin@gmail.com',
            'phone_number' => '0366887398',
            'password' => bcrypt(12345678),
            'description' => 'Admin',
            'status' => 1,
        ]);

        $adminUser->assignRole($admin);

        $manageUser = User::factory()->create([
            'name' => 'Local Manager',
            'email' => 'localmanager@gmail.com',
            'phone_number' => '0374192543',
            'password' => bcrypt(12345678),
            'description' => 'Manager',
            'status' => 1,
        ]);

        $manageUser->assignRole($manager);

        $userNormal = User::factory()->create([
            'name' => 'Dao Duy Dan',
            'email' => 'daodan2612@gmail.com',
            'phone_number' => '0847652149',
            'email_verified_at' => null,
            'password' => bcrypt(12345678),
            'description' => 'User',
            'status' => 0,
        ]);

        $userNormal->assignRole($user);
    }
}
