<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;
    protected $role;
    protected $userService;

    public function __construct(User $user, Role $role, UserService $userService)
    {
        $this->user = $user;
        $this->role = $role;
        $this->userService = $userService;
    }

    public function index($pp = 15)
    {
        checkPermissions('user.overview');
        $users = $this->user->paginate(15);
        return view('admin.user.index',compact('users'));
    }


    public function create()
    {
        checkPermissions('user.create');
        $roles = $this->role->all();
        return view('admin.user.form',compact('roles'));
    }


    public function store(Request $request)
    {
        checkPermissions('user.create');

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required',
        ]);

        $data = $request->all();

        try {

            $data = $this->userService->encryptPasswordInData($data);
            $user = $this->user->create($data);
            $user->save();

            $this->syncRoles($user, $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }

        return redirect()->route('admin.user.index')->with('success','User Created');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        checkPermissions('user.update');
        $user =  $this->user->find($id);
        $roles = $this->role->all();
        return view('admin.user.form',compact('user','roles'));
    }


    public function update(Request $request, $id)
    {
        checkPermissions('user.update');

        $request->validate([
            'username' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
        ]);

        $data = $request->all();

        try {
            $user =  $this->user->find($id);
            $data = $this->userService->encryptPasswordInData($data);
            $user->update($data);

            $this->syncRoles($user, $data);

        } catch (\Exception $e) {
            return redirect()->back()->with('danger',$e->getMessage());
        }
        return redirect()->route('admin.user.index')->with('success','User updated');
    }


    public function destroy($id)
    {
        checkPermissions('user.delete');
        try {
            $this->user->find($id)->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
        return redirect()->route('admin.user.index')->with('success','User deleted');
    }


    private function syncRoles($user, $data){
        $data['roles'] = $data['roles'] ?? [];
        $user->roles()->sync($data['roles']);
    }

    public function loginAsUser(Request $request, $user_id){
        checkPermissions('user.login_as');
        $request->session()->push('loggedInAs', auth()->user()->id);
        auth()->loginUsingId($user_id);
        return redirect()->route('guest.index');
    }

    public function returnToOwnUser(Request $request){

        $user_id = $request->session()->pull('loggedInAs');
        $request->session()->forget('loggedInAs');
        auth()->loginUsingId($user_id);
        return redirect()->route('guest.index');
    }
}
