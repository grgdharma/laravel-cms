<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PostCategory;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title'         => 'Miscellaneous',
                'slug'          => 'miscellaneous',
                'status'        => 1,
                'sort_order'    => 0
            ],
            [
                'title'         => 'Web development',
                'slug'          => 'web-development',
                'status'        => 1,
                'sort_order'    => 0
            ]
        ];

        foreach ($categories as $category) {
            PostCategory::create($category);
        }
    }
}
