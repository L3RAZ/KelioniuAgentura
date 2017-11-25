<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
        $role_employee->name = 'Darbuotojas';
        $role_employee->description = 'Darbuotojas';
        $role_employee->save();

        $role_administrator = new Role();
        $role_administrator->name = 'Administratorius';
        $role_administrator->description = 'Administratorius';
        $role_administrator->save();

        $role_client = new Role();
        $role_client->name = 'Klientas';
        $role_client->description = 'Klientas';
        $role_client->save();
    }
}
