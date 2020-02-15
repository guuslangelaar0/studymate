<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permission;
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function index($pp = 15)
    {
        checkPermissions('permission.overview');
        $permissions = $this->permission->paginate(15);
        return view('admin.permission.index',compact('permissions'));
    }


    public function create()
    {
        checkPermissions('permission.create');
        return view('admin.permission.form');
    }


    public function store(Request $request)
    {
        checkPermissions('permission.create');
        try {
            $data = $request->all();
            $permission = $this->permission->create($data);
            $permission->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }

        return redirect()->route('admin.permission.index')->with('success','Permission Created');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        checkPermissions('permission.update');
        $permission =  $this->permission->find($id);
        return view('admin.permission.form',compact('permission'));
    }


    public function update(Request $request, $id)
    {
        checkPermissions('permission.update');
        try {
            $data = $request->all();
            $permission =  $this->permission->find($id);
            $permission->update($data);

        } catch (\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }
        return redirect()->route('admin.permission.index')->with('success','Permission updated');
    }


    public function destroy($id)
    {
        checkPermissions('permission.delete');
        try {
            $this->permission->find($id)->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
        return redirect()->route('admin.permission.index')->with('success','Permission deleted');
    }
}
