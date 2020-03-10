<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$ci8.NHFEPAXT59geQqugVeSmfDmi6SyD2dr/xf5ow9Dl3uWNPANL.',
                'remember_token' => null,
            ],
        ];

        User::insert($users);

    }
}
