<?php

namespace App\Http\Controllers;

use App\Models\Employee;
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
        $karyawan = Employee::count();
        $aktif = DB::table('employee')->where('status', '=', 'aktif')->count();
        $pasif = DB::table('employee')->where('status', '=', 'pasif')->count();
        $pelamar = DB::table('employee')->where('status', '=', 'pelamar')->count();
        return view('home', compact('karyawan', 'aktif', 'pasif', 'pelamar'));
    }
}
