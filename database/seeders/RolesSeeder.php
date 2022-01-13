<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles and assign created permissions

        // this can be done as separate statements
        Role::create(['name' => 'administrator']);
        Role::create(['name' => 'organizer']);
        Role::create(['name' => 'user']);

        User::find('1')->assignRole('administrator');

    }
}
