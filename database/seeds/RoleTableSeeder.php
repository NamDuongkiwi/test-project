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
        //
        $role_student = new Role();
        $role_student->name = 'student';
        $role_student->save();

        $role_manager = new Role();
        $role_manager->name = 'admin';
        $role_manager->save();
    }

}
