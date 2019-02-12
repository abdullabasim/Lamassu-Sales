<?php

use Illuminate\Database\Seeder;
use App\Model\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $role_admin = new Role();
    $role_admin->name = 'Admin';
    $role_admin->description = 'Allow user to create,update,delete DB record';
    $role_admin->save();

    $role_manager = new Role();
    $role_manager->name = 'Data Entry';
    $role_manager->description = 'Allow user to Enter data and print invoice';
    $role_manager->save();
    }
}
