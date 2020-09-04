<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Truncate table
        Role::truncate();

        Role::create(['name' => 'view-users']);
        Role::create(['name' => 'create-users']);
        Role::create(['name' => 'edit-users']);
        Role::create(['name' => 'delete-users']);
        Role::create(['name' => 'create-chatroom']);
    }
}
