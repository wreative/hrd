<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Detailed;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
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
        $employee = Employee::with('relationContract', 'relationDetailed')
            ->get();
        return view('pages.data.employee.indexEmployee', [
            'employee' => $employee
        ]);
    }

    public function create()
    {
        $code = "EID" . str_pad(
            $this->generatedCode('employee'),
            4,
            '0',
            STR_PAD_LEFT
        );
        return view('pages.data.employee.createEmployee', [
            'code' => $code,
            'position' => Position::all()
        ]);
    }

    public function store(Request $req)
    {
        Validator::make($req->all(), [
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
        ])->validate();

        // Nulled 
        if ($req->gaji == "0") {
            return Redirect::route('employee.create')
                ->with(['status' => 'Gaji tidak boleh kosong']);
        } elseif ($req->hasFile('foto')) {
            $imagePath = $req->file('foto');
            $fileName =  $req->nik . '.' . $imagePath->getClientOriginalExtension();
            $imagePath->move(public_path('storage'), $fileName);
        } else {
            $fileName = '';
        }

        Contract::create([
            'tgl_masuk' => $req->masuk,
            'akhir_kontrak' => $req->kontrak,
            'gaji' => str_replace(',', '', $req->gaji),
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

        $count = $this->countID('detailed');

        Employee::create([
            'nik' => $req->nik,
            'kode' => $req->kode,
            'nama' => $req->name,
            'jk' => $req->jk,
            'photo' => $fileName,
            'status' => $req->status,
            'keterangan' => $req->ket,
            'detail' => $count,
            'kontrak' => $count,
            'rek' => $req->rek
        ]);

        return redirect()->route('employee.index');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $contract = Contract::find($id);
        $detail = Detailed::find($id);
        if (Storage::disk('public')->exists($employee->photo)) {
            Storage::disk('public')->delete($employee->photo);
        }
        $contract->delete();
        $detail->delete();
        $employee->delete();
        return redirect()->route('employee.index');
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

    public function generatedCode($table)
    {
        do {
            $random = rand(00001, 99999);
            $check = DB::table($table)
                ->select('kode')
                ->having('kode', '=', $random)
                ->first();
        } while ($check != null);
        return $random;
    }

    public function countID($table)
    {
        return DB::table($table)->count() == 0 ?
            1 :
            DB::table($table)
            ->select('id')
            ->orderByDesc('id')
            ->limit('1')
            ->first()->id;
    }
}
