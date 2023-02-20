<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $verification_code = rand(999999,111111);
        $users = [
            [
                'name' => 'Dharma Gurung',
                'email' => 'gurungdrg30@gmail.com',
                'mobile' => '9843690989',
                'password' => bcrypt('password123'),
                'email_verified_at' => date('Y-m-d g:i:s'),
                'verification_code' => $verification_code
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
