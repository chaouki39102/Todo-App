<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Abdessadok Chaouki',
            'email' => 'zgoum39102@gmail.com',
            'password' => Hash::make('123'),
            'avatar' => '\assets\images\users\chaouki.jpg',
            'user_type' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'Thabet Righi',
            'email' => 'thabet@gmail.com',
            'password' => Hash::make('123'),
            'avatar' => '\assets\images\users\thabet.png',
            'user_type' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'Zakaria Abdrabi',
            'email' => 'zata@gmail.com',
            'password' => Hash::make('123'),
            'avatar' => '\assets\images\users\zata.jpg',
            'user_type' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'Saber Souid',
            'email' => 'saber@gmail.com',
            'password' => Hash::make('123'),
            'avatar' => '\assets\images\users\saber.jpg',
            'user_type' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'Oualid Adouani',
            'email' => 'walid@gmail.com',
            'password' => Hash::make('123'),
            'avatar' => '\assets\images\users\walid.jpg',
            'user_type' => 'admin',
        ]);
        // User::factory()->create([
        //     'name' => '',
        //     'email' => '@gmail.com',
        //     'password' => Hash::make('123'),
        //     'avatar' => '',
        //     'user_type' => 'admin',
        // ]);
    }
}
