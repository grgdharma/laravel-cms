<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminRole;
class AdminRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
			['name' => 'Master Admin'],
			['name' => 'Admin'],
			['name' => 'Editor'],
            ['name' => 'Other']
		];
  
		foreach ($roles as $role) {
            AdminRole::create($role);
    	}
    }
}
