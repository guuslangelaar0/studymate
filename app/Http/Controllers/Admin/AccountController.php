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

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return $this->redirectToLoginWithError();
        }

        $existingUser = User::where('google_id', $user->getId())->first();
        if($existingUser){
            auth()->login($existingUser, true);
        }
        return $this->redirectToLoginWithError();
    }
}
