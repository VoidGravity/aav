<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //use rseeder 
        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@email.com';
        // password hah of 'password'
        $admin->password = Hash::make('password');
        $admin->role = 'admin';
        $admin->save();
    }
}
