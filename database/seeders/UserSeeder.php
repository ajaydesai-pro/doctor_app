<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Doctor',
                'email' => 'doctor@email.com',
                'password' => bcrypt('password'),
                'role' => 'doctor'
            ],
            [
                'name' => 'Client',
                'email' => 'client@email.com',
                'password' => bcrypt('password'),
                'role' => 'client'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
