<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {   
        \App\Models\User::create([
            'name' => 'reader', 
            'email'=> 'reader@mail.ru',
            'password' => Hash::make('123456'),
            'role_id'=>2
        ]);
    }
}
