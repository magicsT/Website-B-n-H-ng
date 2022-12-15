<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Traits\DeleteModelTrait;

class AdminRolesController extends Controller
{
    use DeleteModelTrait;
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }
    public function index(){
        $roles = $this->role->paginate(5);
        return view('admin.role.index')->with(compact('roles'));
    }

    public function create(){
        $permissionsParent = $this->permission->where('parent_id',0)->get();
        return view('admin.role.add')->with(compact('permissionsParent'));
    }

    public function store(Request $request){
        $role = $this->role->create([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);

        $role->permission()->attach($request->permission_id);
        return redirect()->route('roles.index');
    }

    public function edit($id){
        $permissionsParent = $this->permission->where('parent_id',0)->get();
        $role = $this->role->find($id);
        $permissionChecked = $role->permission;
        return view('admin.role.edit')->with(compact('permissionsParent','role','permissionChecked'));
    }

    public function update($id, Request $request){
        $role = $this->role->find($id);
        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);

        $role->permission()->sync($request->permission_id);
        return redirect()->route('roles.index');
    }

    public function delete($id){
        return $this->deleteModelTrait($id, $this->role);
    }

    public function createPermission(){
        return view('admin.permission.add');
    }
}
