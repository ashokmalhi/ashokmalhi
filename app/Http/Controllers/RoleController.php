<?php
namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\Role;
use App\Models\Permission;
use DB;

class RoleController extends Controller {
    
	public function index(Request $request) {
		$roles = Role::orderBy('id','DESC')->paginate(10);
		return view('roles.index',compact('roles'))
			->with('i', ($request->input('page', 1) - 1) * 5);
	}

	public function create() {
		$permission = Permission::OrderBy('section')
			->orderBy('sort_order','asc')
			->orderBy(DB::raw('FIELD(description, "List", "View", "Add", "Update", "Remove")'))
			->get();
		return view('roles.create',compact('permission'));
	}

	public function store(Request $request) {
		$input = $request->all();
		$this->validate($request, [
			'name' => 'required',
			//'display_name' => 'required',
			'description' => 'required',
			'permission' => 'required',
		]);
		$role				= new Role();
		$role->name			= $request->input('name');
		$role->display_name	= $request->input('display_name');
		$role->description	= $request->input('description');
		$role->save();

		foreach ($request->input('permission') as $key => $value) {
			$role->attachPermission($value);
		}

		if(isset($input['ss'])) {
			return redirect()->route('roles.edit',$role->id)
				->with('success','Role created successfully');
		} else if(isset($input['san'])){
			return redirect()->route('roles.create')
				->with('success','Role created successfully');
		} else {
			return redirect()->route('roles.index')
				->with('success','Role created successfully');
		}
	}

	public function show($id) {
		$role = Role::find($id);
		if(empty($role)){
			return Redirect::to('roles')->with('error', 'The role ID does not exist');
		}
		$rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
			->where("permission_role.role_id",$id)
			->get();
		return view('roles.show',compact('role','rolePermissions'));
	}

	public function edit($id) {
		$role = Role::find($id);
		if(empty($role)){
			return Redirect::to('roles')->with('error', 'The role ID does not exist');
		}
		$permission = Permission::get();
		$rolePermissions = DB::table("permission_role")->where("permission_role.role_id",$id)
			->pluck('permission_role.permission_id','permission_role.permission_id')->toArray();
		return view('roles.edit',compact('role','permission','rolePermissions'));
	}

	public function update(Request $request, $id) {
		
		$this->validate($request, [
			'display_name'	=> 'required',
			'description'	=> 'required',
			'permission'	=> 'required',
		]);

		$role				= Role::find($id);
		$role->name			= $request->input('display_name');
		$role->display_name	= $request->input('display_name');
		$role->description	= $request->input('description');
		$role->save();

		DB::table("permission_role")->where("permission_role.role_id",$id)->delete();

		foreach ($request->input('permission') as $key => $value) {
			$role->attachPermission($value);
		}

		if(isset($request['us'])) {
			return redirect()->route('roles.edit',$role->id)
				->with('success','Role updated successfully');
		} else {
			return redirect()->route('roles.index')
				->with('success','Role updated successfully');
		}
	}

	public function destroy($id) {
            
            $result = Role::deleteRoleById($id);
            if($result){
                return redirect()->route('roles.index')->with('success','Role deleted successfully');
            }else{
                return redirect()->route('roles.index')->with('error','Something went wrong');
            }
	}
}
