<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use yewei\Access\Models\Role;
use yewei\Access\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$roles = Role::get();
    	
    	$permissions = Permission::get();
    	
//     	$role = Role::findOrFail(5);
    	
//     	dd($role->permissions->lists('id')->toArray());

//     	return $role->permissions->lists('id')->toArray();
    	
    	return view('access.role.index')->withRoles($roles)
    	->withPermissions($permissions);
    }
    
    public function test(){
    	$collection = collect([1, 2, 3, 4, 5, 6, 7]);
    	
    	return $collection->search(4);
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$permissions = Permission::get();
    	 
    	return view("access.role.create")->withPerms($permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	
    	$this->validate($request, [
    			'name' => 'required|min:3',
    			'slug'=>'required',
    			'description'=>'required',
    			'level'=>'required|integer'
    	]);
    	
        $role = Role::create($request->all());
        
        $role->attachePermissions($request->input('permissions'));
        
        return redirect()->route('admin.role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//         dd($id);
    	$role = Role::findOrFail($id);
    	
    	$permissions = Permission::get();
    	
    	return view("role")->withRole($role)
    						->withPerms($permissions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
    	
    	$permissions = Permission::get();
    	
    	return view("access.role.edit")->withRole($role)
    						->withPerms($permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$role = Role::findOrFail($id);
    	
    	$this->validate($request, [
    			'name' => 'required|min:3',
    			'slug'=>'required',
    			'description'=>'required',
    			'level'=>'required|integer'
    	]);
    	$role->update($request->all());
    	
    	$role->detachAllPermissions();
    	$role->attachePermissions($request->input('permissions'));
    	
    	return redirect()->route('admin.role.index');
    	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	Role::destroy($id);
    	return redirect()->route('admin.role.index');
    }
}
