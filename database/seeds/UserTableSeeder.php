<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Admin',
        	'email' => 'admin@admin.pl',
        	'password' => Hash::make('admin') ,
            'auth' => '3',
        ]);

        User::create([
            'name' => 'Pracownik_1',
            'email' => 'p1@wm.pl',
            'password' => Hash::make('prac1') ,
            'auth' => '2',
        ]);
    }
}
