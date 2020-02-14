<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{

    public function __construct()
    {

    }

    public function index(){
        $user = Auth::user();

        return view('admin.dashboard.index', compact('user'));
    }
}
