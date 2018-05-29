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
            'telefon' => '999999999',
            'auth' => '3',
        ]);

    }
}
