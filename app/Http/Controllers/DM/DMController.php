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
        $exams = $this->exam->all();
        return view('deadline-manager.index',compact('modules','exams'));
    }
}
