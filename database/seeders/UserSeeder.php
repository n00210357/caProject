<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //runs trainFactory.php when called in terminal

    //when this is run it attempts to use factory to input 10 filler users into the user table of the database
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();

        $role_user = Role::where('name', 'user')->first();

        $admin = new User();
        $admin->name = 'Tim';
        $admin->email = 'Tim@Tim.com';
        $admin->password = Hash::make('password');
        $admin->save();

        $admin->roles()->attach($role_admin);


        $admin = new User();
        $admin->name = 'Bob';
        $admin->email = 'Bob@Bob.com';
        $admin->password = Hash::make('password');
        $admin->save();

        $admin->roles()->attach($role_user);
    }
}
