<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'first_name' => 'admin-1',
                'last_name' => 'admin-1',
                'email' => 'admin@test.com',
                'password' => Hash::make('admin'),
                'role_id' => 1,
            ],
            [
                'first_name' => 'user',
                'last_name' => 'user',
                'email' => 'user@test.com',
                'password' => Hash::make('user'),
                'role_id' => 2
            ],
        ]);
    }
}
