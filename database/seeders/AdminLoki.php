<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminLoki extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username'=> 'admin',
            'name' => 'Admin',
            'surname' => 'Loki',
            'email' => 'admin@loki.com',
            'password' => Hash::make('Test12345!'),
            'birthdate' => date('Y-m-d'),
            'role' => User::ROLE_ADMIN,
        ]);
    }
}
