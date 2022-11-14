<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Aqib Awan',
            'designation'=> 'All Admin',
            'bio' => 'Owner of group',
            'email' => 'AdminAll12@example.co',
            'password' => bcrypt('1234567'),
            'user_img' => 'No image Found',
            'status' => 'ACTIVE',
            'remember_token'=> 'NUll'
        ]);
    
        $role = Role::create(['name' => 'AllAdmin']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }

    
}
