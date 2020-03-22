<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(){
        $users = User::all();

        return view('guest.index', compact('users'));
    }

    public function user($id){
        $user = $this->user->find($id);
        $finishedModules = $this->getAllFinishedModules($user);
        return view('guest.user',compact('user','finishedModules'));
    }

    private function getAllFinishedModules($user) {
        $finishedModules = new Collection();
        foreach($user->modules as $module) {
            $module_exams = $module->exams->pluck('id')->toArray();
            $user_module_exams = $user->exams()->where('module_id',$module->id)->where('finished',1)->pluck('id')->toArray();
            if(array_diff($module_exams, $user_module_exams) == []) {
                $finishedModules->add($module);
            }
        }
        return $finishedModules;
    }
}
