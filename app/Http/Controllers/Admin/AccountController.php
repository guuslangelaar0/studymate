<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AccountController extends Controller
{

    public function index(){
        $user = auth()->user();
        return view('admin.account.index',compact('user'));
    }
}
