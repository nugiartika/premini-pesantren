<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{

    public function run(): void
    {
        // try {
        //     Permission::create(['name' => 'tambah-users']);
        //     Permission::create(['name' => 'edit-users']);
        //     Permission::create(['name' => 'hapus-users']);
        //     Permission::create(['name' => 'tambah-tulisan']);
        //     Permission::create(['name' => 'edit-tulisan']);
        //     Permission::create(['name' => 'hapus-tulisan']);

        //     Role::create(['name' => 'admin']);
        //     Role::create(['name' => 'penulis']);

        //     $roleAdmin = Role::findByName('admin');
        //     $roleAdmin->givePermissionTo('tambah-users');
        //     $roleAdmin->givePermissionTo('edit-users');
        //     $roleAdmin->givePermissionTo('hapus-users');

        //     $rolePenulis = Role::findByName('penulis');
        //     $rolePenulis->givePermissionTo('tambah-tulisan');
        //     $rolePenulis->givePermissionTo('edit-tulisan');
        //     $rolePenulis->givePermissionTo('hapus-tulisan');
        // } catch (\Exception $e) {
        //     echo "Seeder gagal: " . $e->getMessage() . "\n";
        // }
    }
}
