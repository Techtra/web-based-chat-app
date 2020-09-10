<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $create_userRole = Role::where('name', 'create-user')->first();
        $edit_userRole = Role::where('name', 'edit-user')->first();
        $delete_userRole = Role::where('name', 'delete-user')->first();
        $view_userRole = Role::where('name', 'view-user')->first();
        $create_chatroomRole = Role::where('name', 'create-chatroom')->first();

        $admin = User::create([
            'name' => 'Frederick Boakye',
            'email' => 'fred@example.com',
            'phone' => '0264548710',
            'type_id' => '1',
            'password' => Hash::make('password'),
        ]);
        
        $executive = User::create([
            'name' => 'James Boahen',
            'email' => 'james@example.com',
            'phone' => '0205602302',
            'type_id' => '3',
            'password' => Hash::make('password'),
        ]);

        $manager = User::create([
            'name' => 'Veronica Agbley',
            'email' => 'vero@example.com',
            'phone' => '026610114',
            'type_id' => '2',
            'password' => Hash::make('password'),
        ]);

        $employee = User::create([
            'name' => 'Lucy Aku',
            'email' => 'lucy@example.com',
            'phone' => '0244125412',
            'type_id' => '2',
            'password' => Hash::make('password'),
        ]);

        $admin->roles()->attach($create_userRole);
        $executive->roles()->attach($edit_userRole);
        $manager->roles()->attach($delete_userRole);
        $employee->roles()->attach($view_userRole);


    }
}
