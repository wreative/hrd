<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Detailed;
use Illuminate\Http\Request;
use App\Models\Employees;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmployeesController extends Controller
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
        $karyawan = Employees::with('relationContract', 'relationDetailed')->get();
        // dd($karyawan);
        return view('pages.master.karyawan.karyawan', compact('karyawan'));
    }

    public function create()
    {
        $karyawan = DB::table('employees')->count();
        $kode = "EID" . str_pad($karyawan, 4, '0', STR_PAD_LEFT);
        $jabatan = $this->dataJabatan();
        return view('pages.master.karyawan.createKaryawan', ['jabatan' => $jabatan, 'kode' => $kode]);
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'nik' => 'required|digits:16',
            'name' => 'required',
            'jk' => 'required',
            'divisi' => 'required',
            'jabatan' => 'required',
            'masuk' => 'required|date',
            'kontrak' => 'required|date',
            'gaji' => 'required',
            'alm' => 'required',
            'kota' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'tlp' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,svg|max:2000',
            'status' => 'required',
        ]);

        if ($req->gaji == "0") {
            return redirect()->route('createEmployees')->with(['status' => 'Harga tidak boleh kosong']);
        }

        if ($req->hasFile('foto')) {
            $imagePath = $req->file('foto');
            $fileName =  $req->nik . '.' . $imagePath->getClientOriginalExtension();
            $imagePath->move(public_path('storage/photo'), $fileName);
        } else {
            $fileName = '';
        }

        // Long Works as day
        // $date1 = strtotime($req->masuk);
        // $date2 = strtotime($req->kontrak);
        // $hasil = $date2 - $date1;
        // print(round(abs($hasil / 86400)));
        // dd(round(abs($hasil / 86400)));


        $gaji = str_replace(',', '', $req->gaji);

        Contract::create([
            'tgl_masuk' => $req->masuk,
            'akhir_kontrak' => $req->kontrak,
            'gaji' => $gaji,
            'no_jaminan' => $req->no_jmn,
            'jenis_jaminan' => $req->jmn,
        ]);

        Detailed::create([
            'divisi' => $req->divisi,
            'jabatan' => $req->jabatan,
            'alamat' => $req->alm,
            'kota' => $req->kota,
            'tmp_lahir' => $req->tmp_lahir,
            'tgl_lahir' => $req->tgl_lahir,
            'tlp' => $req->tlp,
            'lama_bulan' => $req->lb,
        ]);

        // if (DB::table('detailed')->count() != '0') {
        //     $count = DB::table('detailed')->select('id')->orderByDesc('id')->limit('1')->first();
        // } else {
        //     $count = DB::table('detailed')->count();
        // }

        $count = DB::table('detailed')->select('id')->orderByDesc('id')->limit('1')->first();

        Employees::create([
            'nik' => $req->nik,
            'kode' => $req->kode,
            'nama' => $req->name,
            'jk' => $req->jk,
            'photo' => $fileName,
            'status' => $req->status,
            'keterangan' => $req->ket,
            'detail' => $count->id,
            'kontrak' => $count->id,
            'rek' => $req->rek
        ]);

        return redirect()->route('employees.index');
    }

    public function destroy($id)
    {
        $karyawan = Employees::find($id);
        $kontrak = Contract::find($id);
        $detail = Detailed::find($id);
        if (Storage::disk('public')->exists('photo/' . $karyawan->photo)) {
            Storage::disk('public')->delete('photo/' . $karyawan->photo);
        }
        $karyawan->delete();
        $kontrak->delete();
        $detail->delete();
        return redirect()->route('employees.index');
    }

    public function edit($id)
    {
        $karyawan = Employees::with('relationContract', 'relationDetailed')->find($id);
        $jabatan = $this->dataJabatan();
        return view('pages.master.karyawan.updateKaryawan', compact('karyawan', 'jabatan'));
    }

    public function update($id, Request $req)
    {
        $this->validate($req, [
            'nik' => 'required|digits:16',
            'name' => 'required',
            'jk' => 'required',
            'divisi' => 'required',
            'jabatan' => 'required',
            'masuk' => 'required|date',
            'kontrak' => 'required|date',
            'gaji' => 'required',
            'alm' => 'required',
            'kota' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'tlp' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,svg|max:2000',
            'status' => 'required',
        ]);

        if ($req->gaji == "0") {
            return redirect()->route('createEmployees')->with(['status' => 'Harga tidak boleh kosong']);
        }

        $karyawan = Employees::find($id);

        if ($req->hasFile('foto')) {
            $imagePath = $req->file('foto');
            $fileName =  $req->nik . '.' . $imagePath->getClientOriginalExtension();
            $imagePath->move(public_path('storage/photo'), $fileName);
            $karyawan->photo = $fileName;
        }

        $gaji = str_replace(',', '', $req->gaji);

        // Stored Employees
        $karyawan->nik = $req->nik;
        $karyawan->nama = $req->name;
        $karyawan->jk = $req->jk;
        $karyawan->status = $req->status;
        $karyawan->keterangan = $req->ket;
        $karyawan->rek = $req->rek;

        // Find ID
        $detail = Detailed::find($karyawan->kontrak);
        $kontrak = Contract::find($karyawan->kontrak);

        // Stored Contract
        $kontrak->tgl_masuk = $req->masuk;
        $kontrak->akhir_kontrak = $req->kontrak;
        $kontrak->gaji = $gaji;
        $kontrak->no_jaminan = $req->no_jmn;
        $kontrak->jenis_jaminan = $req->jmn;

        // Stored Detailed
        $detail->divisi = $req->divisi;
        $detail->jabatan = $req->jabatan;
        $detail->alamat = $req->alm;
        $detail->kota = $req->kota;
        $detail->tmp_lahir = $req->tmp_lahir;
        $detail->tgl_lahir = $req->tgl_lahir;
        $detail->tlp = $req->tlp;
        $detail->lama_bulan = $req->lb;

        // Saved Datas
        $karyawan->save();
        $kontrak->save();
        $detail->save();
        return redirect()->route('employees.index');
    }

    public function show($id)
    {
        $karyawan = Employees::with('relationContract', 'relationDetailed')->find($id);
        return view('pages.master.karyawan.infoKaryawan', compact('karyawan'));
    }

    public function dataJabatan()
    {
        $jabatan = array(
            'Direktur',
            'Manager',
            'Koordinator',
            'Staff',
            'Karyawan',
            'Helper',
            'Driver',
            'Office Boy',
            'Kitchen',
            'Gudang',
            'Operator',
        );
        return $jabatan;
    }
}
