<?php

namespace App\Http\Controllers\DM;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Module;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DMController extends Controller
{
    protected $module;
    protected $exam;

    public function __construct(Module $module, Exam $exam)
    {
        $this->module = $module;
        $this->exam = $exam;
    }

    public function index(Request $request) {
        $modules = $this->module->all();
        $userModules = auth()->user()->modules->pluck('id')->toArray();

        $sortBy = $request['orderBy'];
        if($sortBy != null) {
            $sortBy = explode(',',$request['orderBy']);
            $orderBy = $sortBy[0];
            $orderByDir = $sortBy[1] ?? 'desc';
            $exams = auth()->user()->exams();
            switch($orderBy) {
                case 'module':
                    $examsEnrolled = $exams
                        ->join('modules','exams.module_id', '=', 'modules.id')
                        ->orderBy('short_name',$orderByDir)
                        ->get();
                    break;
                case 'exam':
                    $examsEnrolled = $exams
                        ->orderBy('label',$orderByDir)
                        ->get();
                    break;
                case 'teacher':
                    $examsEnrolled = $exams
                        ->join('modules','exams.module_id', '=', 'modules.id')
                        ->join('module_teachers','modules.id','=','module_teachers.module_id')
                        ->join('teachers','module_teachers.teacher_id','=','teachers.id')
                        ->orderBy('teachers.firstname',$orderByDir)
                        ->get()
                        ->unique();
                    break;
                case 'start_date':
                    $examsEnrolled = $exams
                        ->orderBy('start_date',$orderByDir)
                        ->get();
                    break;
                case 'end_date':
                    $examsEnrolled = $exams
                        ->orderBy('end_date',$orderByDir)
                        ->get();
                    break;
                case 'tag':
                    $examsEnrolled = $exams
                        ->orderBy('tag',$orderByDir)
                        ->get();
                    break;
                case 'finished':
                    $examsEnrolled = $exams
                        ->orderBy('finished',$orderByDir)
                        ->get();
                    break;
                default:
                    $examsEnrolled = auth()->user()->exams;
            }
        } else {
            $examsEnrolled = auth()->user()->exams;
        }


        $examsNotEnrolled = $this->exam
            ->whereIn('module_id', $userModules)
            ->whereNotIn('id', $examsEnrolled->pluck('id')->toArray())
            ->get();

        $tagList = [
            '',
            'makkelijk',
            'moeilijk',
            'veel werk',
            'weinig werk',
            'leuk',
            'niet leuk'
        ];

        return view('deadline-manager.index',compact('modules', 'examsEnrolled', 'examsNotEnrolled', 'tagList'));
    }

    public function edit($id) {
        $exam = auth()->user()->exams->find($id);
        return view('deadline-manager.edit',compact('exam'));
    }

    public function update(Request $request, $id) {
        $request->validate([
           'file' => 'mimes:zip,rar'
        ]);

        $data = $request->all();

        try {
            if($request->file('file') != null) {

                $filePath = Storage::disk('public')
                    ->putFileAs(
                        'exam_files/users/' . auth()->user()->id . '/' . Str::random(40),
                            $request->file('file'),
                            $request->file('file')->getClientOriginalName()
                    );
            }

            auth()->user()->exams()->syncWithoutDetaching([$id => [
                'file' => $filePath ?? null,
                'finished' => $data['finished'] ?? 0,
                'tag' => $data['tag'] ?? null,
                'grade' => $data['grade'] ?? null,
            ]]);
        } catch (Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }
        return redirect()->route('admin.dm.index')->with('success','Updated exam');
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
            $exam = auth()->user()->exams()->find($id);
            $finished = isset($data['finished']) ? $data['finished'] : 0;
            $tag = $data['tag'] ?? $exam->pivot->tag;
            //sync exam
            auth()->user()->exams()->syncWithoutDetaching(
                [$id =>
                    [
                        'finished' => $finished,
                        'tag' => $tag
                    ]
                ]);

        } catch(\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }
        return redirect()->back()->with('success','Exam updated');
    }
}
