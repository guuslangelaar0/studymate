<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $role;
    protected $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index($pp = 15)
    {
        $roles = $this->role->paginate(15);
        return view('admin.role.index',compact('roles'));
    }


    public function create()
    {
        $permissions = $this->permission->all();
        return view('admin.role.form',compact('permissions'));
    }


    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $role = $this->role->create($data);
            $role->save();

            $this->syncPermissions($role, $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }

        return redirect()->route('admin.role.index')->with('success','Role Created');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $permissions = $this->permission->all();
        $role =  $this->role->find($id);
        return view('admin.role.form',compact('role','permissions'));
    }


    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $role =  $this->role->find($id);
            $role->update($data);

            $this->syncPermissions($role, $data);

        } catch (\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }
        return redirect()->route('admin.role.index')->with('success','Role updated');
    }


    public function destroy($id)
    {
        try {
            $this->role->find($id)->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
        return redirect()->route('admin.role.index')->with('success','Role deleted');
    }

    private function syncPermissions($role, $data){
        if(!empty($data['permissions'])){
            $role->permissions()->sync($data['permissions']);
        }
    }
}
