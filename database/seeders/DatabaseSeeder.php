<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminRoleTableSeeder::class,
            AdminTableSeeder::class,
            UserTableSeeder::class,
            GeneralTableSeeder::class,
            SystemAuthorizationTableSeeder::class,
            PostCategorySeeder::class,
            PostSeeder::class,
            PageSeeder::class,
        ]);
    
    }
}
