<?php

use Illuminate\Database\Seeder;
use App\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       UserType::truncate();
       
       UserType::create(['name' => 'Administrator']);
       UserType::create(['name' => 'Executive']);
       UserType::create(['name' => 'Manager']);
       UserType::create(['name' => 'Employee']);


    }
}
