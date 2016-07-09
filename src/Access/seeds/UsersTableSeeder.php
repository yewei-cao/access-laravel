<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Models\Access\User\Permission;
use App\Models\Access\User\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
    	$user = config('auth.providers.users.model')::first();
    	
    	$permission = new Permission();
    	$permission2 = new Permission();
    	$permission3 = new Permission();
    	
    	$permission->name = "admin";
    	$permission->slug = "manage the panel";
    	$permission->description = "administrator of the system.";
    	$permission-> model  = "";
    	$permission->created_at   = Carbon::now();
    	$permission->updated_at   = Carbon::now();
    	$permission->save();
    	
    	
    	$permission2->name = "edition";
    	$permission2->slug = "edit role and permission";
    	$permission2->description = "Allow to Edit the Roles and Permission.";
    	$permission2-> model  = "";
    	$permission2->created_at   = Carbon::now();
    	$permission2->updated_at   = Carbon::now();
    	$permission2->save();
    	
    	$permission3->name = "create";
    	$permission3->slug = "create role and permission";
    	$permission3->description = "Allow to create the Roles and Permission.";
    	$permission3-> model  = "";
    	$permission3->created_at   = Carbon::now();
    	$permission3->updated_at   = Carbon::now();
    	$permission3->save();
    	
    	$role = new Role();
    	$nomal_role = new Role();
    	
    	$role->name = "admin";
    	$role->slug = "administrator of system";
    	$role->description = "manage backend";
    	$role->level = "9";
    	$role->created_at   = Carbon::now();
    	$role->updated_at   = Carbon::now();
    	$role->save();
    	
    	$nomal_role->name = "user";
    	$nomal_role->slug = "new role for testing";
    	$nomal_role->description = "new role for testing";
    	$nomal_role->level = "3";
    	$nomal_role->created_at   = Carbon::now();
    	$nomal_role->updated_at   = Carbon::now();
    	$nomal_role->save();
    	
    	$role->attachPermission($permission);
    	$role->attachPermission($permission2);
    	$role->attachPermission($permission3);
    	
    	$user->assignRole($role);
    	
    }
}
