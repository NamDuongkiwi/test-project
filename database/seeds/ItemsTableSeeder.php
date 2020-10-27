<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Student::truncate();
        $fake  = Faker\Factory::create();
        $limit = 50;
        for ($i = 0; $i < $limit; $i++){
            DB::table('student')->insert([
                'student_id' => $fake->biasedNumberBetween(17020001, 17029999),
                'student_name' => $fake->name,
                'DateOfBirth' => $fake->dateTime,
                'Sex' => $fake->randomElement(array('male', 'female')),
                'email' => $fake->unique->email,
                'password' => $fake->biasedNumberBetween(10000000, 17020100),
                'faculty_id' => 2
            ]);
        }
    }
}
