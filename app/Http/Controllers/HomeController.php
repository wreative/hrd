<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
        $karyawan = Employees::count();
        $aktif = DB::table('employees')->where('status', '=', 'aktif')->count();
        $pasif = DB::table('employees')->where('status', '=', 'pasif')->count();
        $pelamar = DB::table('employees')->where('status', '=', 'pelamar')->count();
        return view('home', compact('karyawan', 'aktif', 'pasif', 'pelamar'));
    }
}
