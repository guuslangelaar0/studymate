<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ModuleController extends Controller
{

    public function index()
    {
        $modules = Module::all();
        return view('admin.module.index',compact('modules'));
    }


    public function create()
    {
        return view('admin.module.create');
    }


    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $module = new Module($data);
            $module->save();
        } catch (\Exception $e){
            return redirect()->back()->with('danger',$e->getMessage());
        }

        return redirect()->route('admin.module.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
