<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::all();
        return view('pages.master.user.user', compact('user'));
    }

    public function create()
    {
        return view('pages.master.user.createUser');
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'previleges' => ['required']
        ]);

        User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'previleges' => $req->previleges,
        ]);
        return redirect()->route('masterUser');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('masterUser');
    }

    public function changeName(Request $req)
    {
        $this->validate($req, [
            'name' => ['required', 'string', 'max:255']
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = $req->name;
        $user->save();
        return redirect()->route('home');
    }

    public function changePassword()
    {
        return view('pages.master.user.changePassword');
    }
}
