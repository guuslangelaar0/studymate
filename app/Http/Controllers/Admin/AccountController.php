<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AccountController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(){
        $user = auth()->user();
        return view('admin.account.index',compact('user'));
    }

    public function edit() {
        $user = auth()->user();
        return view('admin.account.edit',compact('user'));
    }

    public function update(Request $request) {
        $request->validate([
            'username' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
        ]);

        $data = $request->all();
        try {
            $user = auth()->user();
            $data = $this->userService->encryptPasswordInData($data);
            $user->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }
        return redirect()->back()->with('success','Your account has been updated');
    }
}
