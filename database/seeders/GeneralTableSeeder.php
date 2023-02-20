<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\General;
class GeneralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $general = [
            [
                'key' => 'site_status',
		    	'value' => ''
            ],
            [
                'key' => 'site_title',
		    	'value' => 'Your Site'
            ],
            [
                'key' => 'site_email',
		    	'value' => 'helloex@yourdomain.com'
            ],
            [
                'key' => 'site_phone',
		    	'value' => ''
            ],
            [
                'key' => 'site_address',
		    	'value' => ''
            ],
            [
                'key' => 'site_copyright',
		    	'value' => ''
            ],
            [
                'key' => 'site_meta_title',
		    	'value' => 'Just another site'
            ],
            [
                'key' => 'site_meta_keyword',
		    	'value' => ''
            ],
            [
                'key' => 'site_meta_description',
		    	'value' => ''
            ],
            [
                'key' => 'site_facebook',
		    	'value' => 'https://www.facebook.com'
            ],
            [
                'key' => 'site_instagram',
		    	'value' => 'https://instagram.com'
            ],
            [
                'key' => 'site_logo_web',
		    	'value' => ''
            ],
            [
                'key' => 'site_logo_web_footer',
		    	'value' => ''
            ],
            [
                'key' => 'site_featured_image',
		    	'value' => ''
            ],
            [
                'key' => 'coming_soon_image',
		    	'value' => ''
            ],
            [
                'key' => 'file_storage_disk',
		    	'value' => ''
            ]
        ];

        foreach ($general as $value) {
            General::create($value);
        }
    }
}
