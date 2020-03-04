<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Module;
use Illuminate\Http\Request;

class ExamController extends Controller
{

    protected $module;
    protected $exam;

    public function __construct(Module $module, Exam $exam)
    {
        $this->module = $module;
        $this->exam = $exam;
    }

    public function index($module_id)
    {
        $module = $this->module->find($module_id);
        $exams = $module->exams;
        return view('admin.module.exams.index',compact('module', 'exams'));
    }


    public function create($module_id)
    {
        checkPermissions('module.create');
        $module = $this->module->find($module_id);
        return view('admin.module.exams.form', compact('module'));
    }


    public function store(Request $request)
    {
        checkPermissions('module.create');

        try {
            $data = $request->all();
            $exam = $this->exam->create($data);
            $exam->save();

        } catch (\Exception $e){
            return redirect()->back()->with('danger',$e->getMessage());
        }

        return redirect()->route('admin.module.exam.index')->with('success','Exam stored');
    }


    public function show($id)
    {
        //
    }


    public function edit($module_id, $id)
    {
        checkPermissions('module.update');
        $exam = $this->exam->find($id);
        $module = $this->module->find($id);
        return view('admin.module.form',compact('module', 'exam'));
    }


    public function update(Request $request, $id)
    {
        checkPermissions('module.update');
        try {
            $data = $request->all();
            $exam = $this->module->find($id);
            $exam->update($data);

        } catch (\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }
        return redirect()->route('admin.module.exam.index')->with('success','Exam updated');
    }


    public function destroy($id)
    {
        checkPermissions('module.delete');
        try {
            $module = $this->module->find($id);
            $module->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('danger','Module could not be deleted');
        }
        return redirect()->route('admin.module.index')->with('success','Module deleted');
    }
}
