<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $teacher;
    public function __construct(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }

    public function index($pp = 15)
    {
        $teachers = $this->teacher->paginate(15);
        return view('admin.teacher.index',compact('teachers'));
    }


    public function create()
    {
        return view('admin.teacher.form');
    }


    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $teacher = new Teacher($data);
            $teacher->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }

        return redirect()->route('admin.teacher.index')->with('success','Teacher Created');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $teacher =  $this->teacher->find($id);
        return view('admin.teacher.form',compact('teacher'));
    }


    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $teacher =  $this->teacher->find($id);
            $teacher->update($data);

        } catch (\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }
        return redirect()->route('admin.teacher.index')->with('success','Teacher updated');
    }


    public function destroy($id)
    {
        try {
            $this->teacher->find($id)->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
        return redirect()->route('admin.teacher.index')->with('success','Teacher deleted');
    }
}
