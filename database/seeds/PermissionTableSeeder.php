<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'book-list',
           'book-create',
           'book-edit',
           'book-delete',
           'author-list',
           'author-create',
           'author-edit',
           'author-delete',
           'media-list',
           'media-create',
           'media-edit',
           'media-delete',
           'category-list',
           'category-create',
           'category-edit',
           'category-delete',
           'team-list',
           'team-create',
           'team-edit',
           'team-delete'

        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }  
}

