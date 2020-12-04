<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Salary;
use App\Models\Loyalty;

class LoyaltyController extends Controller
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
        $karyawan = Employees::with('relationContract')->get();
        return view('pages.master.gaji.loyalty', ['karyawan' => $karyawan]);
    }

    public function create()
    {
        $karyawan = Employees::with('relationDetailed')->get();
        return view('pages.master.gaji.createLoyalty', ['karyawan' => $karyawan]);
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'absen' => 'required|max:20',
            'waktu' => 'required|max:10',
            'uniform' => 'required|max:5',
            'sop' => 'required|max:30',
            'tj' => 'required|max:25',
            'kt' => 'required|max:10',
            'rank' => 'required',
            'karyawan' => 'required',
            'amanah' => 'required|max:40',
            'produktif' => 'required|max:35',
            'tw' => 'required|max:25',
        ]);

        $rank = $req->rank == '1' ? 200000 : ($req->rank == '2' ? 100000 : 0);
        $karyawan = Employees::find($req->karyawan);

        // Calculate
        $loyalitas = $req->absen + $req->waktu + $req->uniform + $req->sop + $req->tj + $req->kt;
        $dedikasi = $req->amanah + $req->produktif + $req->tw;

        // Store Data
        // Loyalty::create([
        //     'loyalitas' => $rank * $loyalitas / 100,
        //     'dedikasi' => $rank * $dedikasi / 100,
        //     'tanggal' => $req->tgl,
        // ]);

        $karyawan->loyalitas = $rank * $loyalitas / 100;
        $karyawan->dedikasi = $rank * $dedikasi / 100;
        $karyawan->save();

        return redirect()->route('createSalary');
    }
}
