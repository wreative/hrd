<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'roles']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $user = User::where('id', '!=', Auth::user()->id)
            ->get();
        return view('pages.data.users.indexUsers', [
            'user' => $user
        ]);
    }

    public function create()
    {
        return view('pages.data.users.createUsers');
    }

    public function store(Request $req)
    {
        Validator::make($req->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required'
        ])->validate();

        // Stored Data
        User::create([
            'name' => $req->name,
            'username' => $req->username,
            'password' => Hash::make($req->password),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'previleges' => $req->roles
        ]);

        return Redirect::route('user.index');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return Redirect::route('user.index');
    }

    public function changePassword()
    {
        return view('auth.passwords.reset');
    }

    public function changeName(Request $req)
    {
        $this->validate($req, [
            'name' => ['required', 'string', 'max:255']
        ]);

        User::where('id', Auth::user()->id)
            ->update([
                'name' => $req->name,
            ]);

        return Redirect::route('home');
    }
}
