<?php

namespace App\Http\Controllers\Auth\OAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return $this->redirectToLoginWithError();
        }

        if(Auth::user() !== null) {
            $auth = Auth::user();
            $auth->google_id = $user->getId();
            $auth->save();
            return redirect()->route('admin.account.index');
        }

        $existingUser = User::where('google_id', $user->getId())->first();
        if($existingUser){
            auth()->login($existingUser, true);
        }
        return $this->redirectToLoginWithError();
    }

    public function disconnect() {
        if (!Auth::check()) {
            abort(404);
        }

        $user = Auth::user();
        $user->google_id = null;
        $user->save();
        return redirect()->back()->with('Disconnected from your google account');
    }

    private function redirectToLoginWithError(){
        return redirect('/login')->with('alert-danger','Failed to login. Please try again later or contact <a href="mailto:guus@every1online.com">guus@every1online.com</a>');
    }
}
