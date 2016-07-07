<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use yewei\Access\Models\Role;
use yewei\Access\Models\Permission;

class AdminController extends Controller
{
    //
    
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function conpage()
	{
		
// 		Auth::user()->

// 		$roles = Role::select('id')->groupBy('id')->get();
		$roles = Role::get();
		
		$permissions = Permission::get();
		
// 		$roleperms = $roles->permissions->lists('id')->toArray();
		
// 		$role = Role::findOrFail(5);
		
// 		dd($role->permissions->lists('id'));
		
		return view('control')->withRoles($roles)
		->withPermissions($permissions);
// 		->withRoleperms($roleperms);
		
		
		//<a href="#" class="list-group-item {{in_array($perm->id, $role->permissions->id) ? 'active' : ""}} ">{{ $perm->name }}</a>
	}
}
