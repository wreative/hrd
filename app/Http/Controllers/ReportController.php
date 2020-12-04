<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;

class ReportController extends Controller
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

    public function employeesReport()
    {
        $karyawan = Employees::with('relationContract', 'relationDetailed')->get();
        return view('pages.laporan.karyawan.laporanKaryawan', compact('karyawan'));
    }
}
