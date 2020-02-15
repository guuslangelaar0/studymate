<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ModuleController extends Controller
{

    protected $module;
    protected $teacher;

    public function __construct(Module $module, Teacher $teacher)
    {
        $this->module = $module;
        $this->teacher = $teacher;
    }

    public function index()
    {

        $modules = $this->module->all();
        return view('admin.module.index',compact('modules'));
    }


    public function create()
    {
        $teachers = $this->teacher->all();
        return view('admin.module.form', compact('teachers'));
    }


    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $module = new Module($data);
            $module = $module->save();

            $this->sync($module, $data);

        } catch (\Exception $e){
            return redirect()->back()->with('danger',$e->getMessage());
        }

        return redirect()->route('admin.module.index')->with('success','Module stored');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $teachers = $this->teacher->all();
        $module = $this->module->find($id);
        return view('admin.module.form',compact('module', 'teachers'));
    }


    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $module = $this->module->find($id);
            $module->update($data);

            $this->sync($module, $data);

        } catch (\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }
        return redirect()->route('admin.module.index')->with('success','Module updated');
    }


    public function destroy($id)
    {
        try {
            $this->module->find($id)->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('danger','Module could not be deleted');
        }
        return redirect()->route('admin.module.index')->with('success','Module deleted');
    }

    private function sync($module, $data){
        $teachers = [];
        foreach ($data['coordinators'] as $coordinator){
            $teachers[$coordinator] = ['coordinator' => true];
        }
        foreach ($data['teachers'] as $teacher){
            $teachers[$teacher] = ['coordinator' => false];
        }

        $module->teachers()->sync($teachers);

    }
}
