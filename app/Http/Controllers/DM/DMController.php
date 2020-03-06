<?php

namespace App\Http\Controllers\DM;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Module;
use Illuminate\Http\Request;

class DMController extends Controller
{
    protected $module;
    protected $exam;

    public function __construct(Module $module, Exam $exam)
    {
        $this->module = $module;
        $this->exam = $exam;
    }

    public function index() {
        $modules = $this->module->all();
        $userModules = auth()->user()->modules->pluck('id')->toArray();
        $exams = $this->exam
            ->whereIn('module_id',$userModules)
            ->get();

        return view('deadline-manager.index',compact('modules','exams'));
    }

    public function enroll($id) {
        try {
            $module = $this->module->find($id);
            auth()->user()->modules()->attach([$id]);
        } catch (\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }
        return redirect()->back()->with('success','Enrolled for ' . $module->short_name ?? $module->name);
    }

    public function disenroll($id) {
        try {
            $module = $this->module->find($id);
            auth()->user()->modules()->detach([$id]);
        } catch (\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }
        return redirect()->back()->with('success','Disenrolled for ' . $module->short_name ?? $module->name);
    }
}
