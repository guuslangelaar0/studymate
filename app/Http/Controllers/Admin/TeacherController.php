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
        checkPermissions('teacher.overview');
        $teachers = $this->teacher->paginate(15);
        return view('admin.teacher.index',compact('teachers'));
    }


    public function create()
    {
        checkPermissions('teacher.create');
        return view('admin.teacher.form');
    }


    public function store(Request $request)
    {
        checkPermissions('teacher.create');

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email'
        ]);

        $data = $request->all();

        try {

            $teacher = $this->teacher->create($data);
            $teacher->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }

        return redirect()->route('admin.teacher.index')->with('success','Teacher Created');
    }


    public function edit($id)
    {
        checkPermissions('teacher.update');
        $teacher =  $this->teacher->find($id);
        return view('admin.teacher.form',compact('teacher'));
    }


    public function update(Request $request, $id)
    {
        checkPermissions('teacher.update');

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email'
        ]);

        $data = $request->all();

        try {
            $teacher =  $this->teacher->find($id);
            $teacher->update($data);

        } catch (\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }
        return redirect()->route('admin.teacher.index')->with('success','Teacher updated');
    }


    public function destroy($id)
    {
        checkPermissions('teacher.delete');
        try {
            $this->teacher->find($id)->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
        return redirect()->route('admin.teacher.index')->with('success','Teacher deleted');
    }
}
