<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'Dharma Gurung',
                'email' => 'gurungdrg30@gmail.com',
                'password' => bcrypt('BestAdmin@2022'),
                'role_id' => 1,
                'status' => 1
            ]
        ];
        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }
}
