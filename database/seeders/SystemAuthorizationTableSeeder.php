<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SystemAuthorization;
class SystemAuthorizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            [
                'name'      => 'System Administration',
                'route_url' => '',
                'role_id'   => json_encode(["1","2","3","4"]),
                'status'    => 1,
                'sort_order'=> 1,
            ],
            [
                'name'      => 'System User',
                'route_url' => '',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 2,
            ],
            [
                'name'      => 'Catelog',
                'route_url' => '',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 4,
            ],
            [
                'parent_id' => 1,
                'name'      => 'Authorization',
                'route_url' => 'system/authorization',
                'route_name'=> 'system.authorization',
                'role_id'   => json_encode(['1']),
                'status'    => 1,
                'sort_order'=> 1,
                'icon'      => 'shield'
            ],
            [
                'parent_id' => 1,
                'name'      => 'General',
                'route_url' => 'system/general',
                'route_name'=> 'system.general',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'icon'      => 'settings'
            ],
            [
                'parent_id' => 1,
                'name'      => 'Administration',
                'route_url' => 'system/administration',
                'route_name'=> 'system.administration',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => 'user'
            ],
            [
                'parent_id' => 2,
                'name'      => 'Users',
                'route_url' => 'system/user',
                'route_name'=> 'system.user',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => 'users'
            ],
            [
                'parent_id' => 3,
                'name'      => 'Pages',
                'route_url' => 'system/page',
                'route_name'=> 'system.page',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => 'book'
            ],
            [
                'parent_id' => 8,
                'name'      => 'Create',
                'route_url' => 'system/page/create',
                'route_name'=> 'system.page.create',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => 'book'
            ],
            [
                'parent_id' => 8,
                'name'      => 'Edit',
                'route_url' => 'system/page/{page}/edit',
                'route_name'=> 'system.page.edit',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => 'book'
            ],
            [
                'parent_id' => 8,
                'name'      => 'Update',
                'route_url' => 'system/page/{page}',
                'route_name'=> 'system.page.edit',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => 'book'
            ],
            [
                'parent_id' => 3,
                'name'      => 'Posts',
                'route_url' => 'system/post',
                'route_name'=> 'system.post',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => 'book-open'
            ],
            [
                'parent_id' => 12,
                'name'      => 'Create',
                'route_url' => 'system/post/create',
                'route_name'=> 'system.post.create',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => ''
            ],
            [
                'parent_id' => 12,
                'name'      => 'Edit',
                'route_url' => 'system/post/{post}/edit',
                'route_name'=> 'system.post.edit',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => ''
            ],
            [
                'parent_id' => 12,
                'name'      => 'Update',
                'route_url' => 'system/post/{post}',
                'route_name'=> 'system.post.edit',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => ''
            ],
            [
                'parent_id' => 3,
                'name'      => 'Categories',
                'route_url' => 'system/post/category',
                'route_name'=> 'system.post.category',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => 'box'
            ],
            [
                'parent_id' => 16,
                'name'      => 'Create',
                'route_url' => 'system/post/category/create',
                'route_name'=> 'system.post.category.create',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => ''
            ],
            [
                'parent_id' => 16,
                'name'      => 'Edit',
                'route_url' => 'system/post/category/{category}/edit',
                'route_name'=> 'system.post.category.edit',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => ''
            ],
            [
                'parent_id' => 16,
                'name'      => 'Update',
                'route_url' => 'system/post/category/{category}',
                'route_name'=> 'system.post.category.edit',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => ''
            ],
            [
                'parent_id' => 3,
                'name'      => 'Comments',
                'route_url' => 'system/post/comment',
                'route_name'=> 'system.post.comments.list',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 3,
                'icon'      => 'message-circle'
            ],
            [
                'parent_id' => 20,
                'name'      => 'Comment Details',
                'route_url' => 'system/post/detail/{id}/comment',
                'route_name'=> 'system.post.comments.show',
                'role_id'   => json_encode(["1","2"]),
                'status'    => 1,
                'sort_order'=> 0,
                'icon'      => 'arrow-right'
            ],

        ];

        foreach ($permission as $value) {
            SystemAuthorization::create($value);
        }
    }
}
