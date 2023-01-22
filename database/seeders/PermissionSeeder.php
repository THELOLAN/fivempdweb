<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'user.create', 'label' => 'Benutzer - Erstellen']);
        Permission::create(['name' => 'user.edit', 'label' => 'Benutzer - Bearbeiten']);
        Permission::create(['name' => 'user.delete', 'label' => 'Benutzer - Löschen']);
        Permission::create(['name' => 'user.manage', 'label' => 'Benutzer - Verwalten']);
    }
}
