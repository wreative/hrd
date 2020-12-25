<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\LoyaltyDedication;
use App\Models\Loyalty;
use App\Models\Dedication;
use Illuminate\Support\Facades\DB;

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
            'absen' => 'exclude_if:rank,3|required|max:20|numeric|min:0',
            'waktu' => 'exclude_if:rank,3|required|max:10|numeric|min:0',
            'uniform' => 'exclude_if:rank,3|required|max:5|numeric|min:0',
            'sop' => 'exclude_if:rank,3|required|max:30|numeric|min:0',
            'tj' => 'exclude_if:rank,3|required|max:25|numeric|min:0',
            'kt' => 'exclude_if:rank,3|required|max:10|numeric|min:0',
            'amanah' => 'exclude_if:rank,3|required|max:40|numeric|min:0',
            'produktif' => 'exclude_if:rank,3|required|max:35|numeric|min:0',
            'tw' => 'exclude_if:rank,3|required|max:25|numeric|min:0',
            'karyawan' => 'required',
            'rank' => 'required',
            'tgl' => 'required',
        ]);

        // Convert Date
        $date = date("d-m-Y", strtotime($req->tgl));

        $rank = $req->rank == '1' ? 200000 : ($req->rank == '2' ? 100000 : 0);
        $karyawan = Employees::find($req->karyawan);

        // Total
        $loyaltyTotal = $req->absen + $req->waktu + $req->uniform + $req->sop + $req->tj + $req->kt;
        $dedicationTotal = $req->amanah + $req->produktif + $req->tw;
        $loyalty = $rank * $loyaltyTotal / 100;
        $dedication = $rank * $dedicationTotal / 100;

        // Create Data
        Loyalty::create([
            'absen' => $req->absen,
            'waktu' => $req->waktu,
            'uniform' => $req->uniform,
            'sop' => $req->sop,
            'tj' => $req->tj,
            'kt' => $req->kt,
            'total' => $loyaltyTotal,
        ]);

        Dedication::create([
            'amanah' => $req->amanah,
            'produktif' => $req->produktif,
            'tw' => $req->tw,
            'total' => $dedicationTotal,
        ]);

        $count = DB::table('loyalty')->select('id')->orderByDesc('id')->limit('1')->first();

        LoyaltyDedication::create([
            'tgl' => $date,
            'rank' => $req->rank,
            'd_id' => $count,
            'l_id' => $count,
            'loyalitas' => $loyalty,
            'dedikasi' => $dedication,
        ]);

        $karyawan->l_id = $count;
        $karyawan->save();

        return redirect()->route('createSalary');
    }
}
