<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'isAdmin'  => true,
        ]);
        DB::table('users')->insert([
            'name'     => 'Partner1 User',
            'email'    => 'partner1@gmail.com',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name'     => 'Partner2 User',
            'email'    => 'partner2@gmail.com',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name'     => 'Both Partners User',
            'email'    => 'bothpartners@gmail.com',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name'     => 'No Partner User',
            'email'    => 'nopartner@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
