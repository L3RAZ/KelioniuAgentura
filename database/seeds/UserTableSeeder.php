<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = Role::where('name', 'Darbuotojas')->first();
        $role_administrator  = Role::where('name', 'Administratorius')->first();
        $role_client  = Role::where('name', 'Klientas')->first();

        $employee = new User();
        $employee->name = 'Darbuotojas';
        $employee->email = 'darb@keliones.lt';
        $employee->password = bcrypt('darbpass');
        $employee->person_id= 300000000;
        $employee->birth_date=date('1995-12-12');
        $employee->surname='12';
        $employee->save();
        $employee->roles()->attach($role_employee);

        $administrator = new User();
        $administrator->name = 'Admin';
        $administrator->email = 'admin@keliones.lt';
        $administrator->password = bcrypt('adminpass');
        $administrator->person_id= 300000000;
        $administrator->birth_date=date('1995-12-12');
        $administrator->surname='12';
        $administrator->save();
        $administrator->roles()->attach($role_administrator);


        $client = new User();
        $client->name = 'Client';
        $client->email = 'client@keliones.lt';
        $client->password = bcrypt('clientpass');
        $client->person_id= 300000000;
        $client->birth_date=date('1995-12-12');
        $client->surname='12';
        $client->save();
        $client->roles()->attach($role_client);

    }
}
