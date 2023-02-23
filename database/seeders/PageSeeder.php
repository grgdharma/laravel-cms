<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pages;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'title'         => 'About Us',
                'slug'          => 'about-us',
                'description'   => 'This is about us page.',
                'template'      => 'default',
                'status'        => 1,
                'sort_order'    => 0
            ],
            [
                'title'         => 'Terms and Conditions',
                'slug'          => 'term-and-condition',
                'template'      => 'default',
                'description'   => 'This is terms and conditions page.',
                'status'        => 1,
                'sort_order'    => 0
            ]
        ];

        foreach ($pages as $page) {
            Pages::create($page);
        }
    }
}
