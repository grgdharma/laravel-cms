<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SystemPermission;
class SystemPermissionTableSeeder extends Seeder
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
                'role_id'   => json_encode(['1']),
                'status'    => 1,
                'sort_order'=> 2,
            ],
            [
                'name'      => 'Catelog',
                'route_url' => '',
                'role_id'   => json_encode(['1']),
                'status'    => 1,
                'sort_order'=> 4,
            ],
            [
                'parent_id' => 1,
                'name'      => 'Permission',
                'route_url' => 'admin/system/permission',
                'route_name'=> 'admin.dashboard.permission',
                'role_id'   => json_encode(['1']),
                'status'    => 1,
                'sort_order'=> 1,
                'icon'      => 'shield'
            ],
            [
                'parent_id' => 1,
                'name'      => 'General',
                'route_url' => 'admin/general',
                'route_name'=> 'admin.general',
                'role_id'   => json_encode(['1']),
                'status'    => 1,
                'icon'      => 'settings'
            ],
            [
                'parent_id' => 1,
                'name'      => 'Administration',
                'route_url' => 'admin/system/administration',
                'route_name'=> 'admin.dashboard.administration',
                'role_id'   => json_encode(['1']),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => 'user'
            ],
            [
                'parent_id' => 2,
                'name'      => 'Users',
                'route_url' => 'admin/system/user',
                'route_name'=> 'admin.dashboard.user',
                'role_id'   => json_encode(['1']),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => 'users'
            ],
            [
                'parent_id' => 3,
                'name'      => 'Pages',
                'route_url' => 'admin/catalog/page',
                'route_name'=> 'admin.catalog.page',
                'role_id'   => json_encode(['1']),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => 'book'
            ],
            [
                'parent_id' => 8,
                'name'      => 'Create Page',
                'route_url' => 'admin/catalog/create/page',
                'route_name'=> 'admin.catalog.page.create',
                'role_id'   => json_encode(['1']),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => 'book'
            ],
            [
                'parent_id' => 8,
                'name'      => 'Update Page',
                'route_url' => 'admin/catalog/edit/{id}/page',
                'route_name'=> 'admin.catalog.page.edit',
                'role_id'   => json_encode(['1']),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => 'book'
            ],
            [
                'parent_id' => 3,
                'name'      => 'Posts',
                'route_url' => 'admin/post',
                'route_name'=> 'admin.post',
                'role_id'   => json_encode(['1']),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => 'book-open'
            ],
            [
                'parent_id' => 11,
                'name'      => 'Create Post',
                'route_url' => 'admin/create/post',
                'route_name'=> 'admin.post.create',
                'role_id'   => json_encode(['1']),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => ''
            ],
            [
                'parent_id' => 11,
                'name'      => 'Edit Post',
                'route_url' => 'admin/edit/{id}/post',
                'route_name'=> 'admin.post.edit',
                'role_id'   => json_encode(['1']),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => ''
            ],
            [
                'parent_id' => 3,
                'name'      => 'Categories',
                'route_url' => 'admin/category',
                'route_name'=> 'admin.post.category',
                'role_id'   => json_encode(['1']),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => 'box'
            ],
            [
                'parent_id' => 14,
                'name'      => 'Create',
                'route_url' => 'admin/create/category',
                'route_name'=> 'dmin.post.category.create',
                'role_id'   => json_encode(['1']),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => ''
            ],
            [
                'parent_id' => 14,
                'name'      => 'Edit',
                'route_url' => 'admin/edit/{id}/category',
                'route_name'=> 'admin.post.category.edit',
                'role_id'   => json_encode(['1']),
                'status'    => 1,
                'sort_order'=> 2,
                'icon'      => ''
            ],

        ];

        foreach ($permission as $value) {
            SystemPermission::create($value);
        }
    }
}
