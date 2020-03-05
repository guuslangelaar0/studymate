<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        return view('guest.user',compact('user'));
    }
}
