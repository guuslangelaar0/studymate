<?php

namespace App\Http\Controllers\DM;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Module;
use Exception;
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

        $examsEnrolled = auth()->user()->exams;

        $examsNotEnrolled = $this->exam
            ->whereIn('module_id', $userModules)
            ->whereNotIn('id', $examsEnrolled->pluck('id')->toArray())
            ->get();

        return view('deadline-manager.index',compact('modules', 'examsEnrolled', 'examsNotEnrolled'));
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

    public function enrollExam($id) {
        try {
            $exam = $this->exam->find($id);
            auth()->user()->exams()->attach([$id]);
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Enrolled for ' . $exam->label);
    }

    public function unenrollExam($id) {
        try {
            $exam = $this->exam->find($id);
            auth()->user()->exams()->detach([$id]);
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Unenrolled for ' . $exam->label);
    }

    public function updateUserExam(Request $request, $id) {
        $data = $request->all();
        try{
            $finished = isset($data['finished']) ? 1 : 0;
            //sync exam
            auth()->user()->exams()->syncWithoutDetaching([$id => ['finished' => $finished]]);

        } catch(\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }
        return redirect()->back()->with('success','Exam updated');
    }
}
