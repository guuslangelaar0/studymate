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

        $request->validate([
            'module_id' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $data = $request->all();

        if((strtotime($data['end_date']) - strtotime($data['start_date'])) < 0) {
            return redirect()->back()->with('danger','Start date is on a later time than the end date.');
        }

        try {
            $exam = $this->exam->create($data);
            $exam->save();

        } catch (\Exception $e){
            return redirect()->back()->with('danger',$e->getMessage());
        }

        return redirect()->route('admin.module.exam.index',$data['module_id'])->with('success','Exam stored');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        checkPermissions('module.update');
        $exam = $this->exam->find($id);
        $module = $this->module->find($exam->module_id);
        return view('admin.module.exams.form',compact('exam','module'));
    }


    public function update(Request $request, $id)
    {
        checkPermissions('module.update');

        $request->validate([
            'module_id' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $data = $request->all();

        if((strtotime($data['end_date']) - strtotime($data['start_date'])) < 0) {
            return redirect()->back()->with('danger','Start date is on a later time than the end date.');
        }

        try {
            $exam = $this->exam->find($id);
            $module_id = $exam->module_id;
            $exam->update($data);

        } catch (\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }
        return redirect()->route('admin.module.exam.index',$module_id)->with('success','Exam updated');
    }


    public function destroy($id)
    {
        checkPermissions('module.delete');
        try {
            $exam = $this->exam->find($id);
            $module_id = $exam->module_id;
            $exam->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('danger','Exam could not be deleted');
        }
        return redirect()->route('admin.module.exam.index',$module_id)->with('success','Exam deleted');
    }
}
