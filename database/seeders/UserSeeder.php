<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
           [
               'name' => 'admin',
               'username' => 'admin',
               'email' => 'admin@gmail.com',
               'password' => bcrypt('123456'),
               'role' => 'admin',
               'status' => 'active',
           ],
            [
                'name' => 'vendor',
                'username' => 'vendor',
                'email' => 'vendor@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'vendor',
                'status' => 'active',
            ],
            [
                'name' => 'user',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'user',
                'status' => 'active',
            ]
        ]);
    }
}
