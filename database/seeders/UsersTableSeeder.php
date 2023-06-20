<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class UsersTableSeeder extends Seeder
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
                'name' => 'User 1',
                'username' => 'user1',
                'is_active' => true,
                'password' => 'secret'
            ],
            [
                'name' => 'User 2',
                'username' => 'user2',
                'is_active' => true,
                'password' => 'secret'
            ],
            [
                'name' => 'User 3',
                'username' => 'user3',
                'is_active' => true,
                'password' => 'secret'
            ],
        ];

        foreach ($users as $userData) {
            User::create(array_merge(Arr::except($userData, 'role'), ['password' => $userData['password']]));
        }
    }
}
