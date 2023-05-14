<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            'name' => 'admin',
            'sex' => 1,
            'email' => 'admin@mail.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'role' => 'admin'
        ];

        User::create($admin);
    }
}
