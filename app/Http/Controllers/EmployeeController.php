<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Detailed;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;
use Facade\FlareClient\Http\Response;
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
            'position' => Position::all(),
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

        return Redirect::route('employee.index');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $contract = Contract::find($employee->kontrak);
        $detail = Detailed::find($employee->detail);
        if (Storage::disk('public')->exists($employee->photo)) {
            Storage::disk('public')->delete($employee->photo);
        }
        $contract->delete();
        $detail->delete();
        $employee->delete();
        return Redirect::route('employee.index');
    }

    public function edit($id)
    {
        $employee = Employee::with('relationContract', 'relationDetailed')
            ->find($id);
        return view('pages.data.employee.updateEmployee', [
            'employee' => $employee,
            'position' => Position::all()
        ]);
    }

    public function update($id, Request $req)
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

        $employee = Employee::find($id);

        // Stored Employee
        $employee->nik = $req->nik;
        $employee->nama = $req->name;
        $employee->jk = $req->jk;
        $employee->status = $req->status;
        $employee->keterangan = $req->ket;
        $employee->rek = $req->rek;

        // Find ID
        $detail = Detailed::find($employee->detail);
        $contract = Contract::find($employee->kontrak);

        // Stored Contract
        $contract->tgl_masuk = $req->masuk;
        $contract->akhir_kontrak = $req->kontrak;
        $contract->gaji = str_replace(',', '', $req->gaji);
        $contract->no_jaminan = $req->no_jmn;
        $contract->jenis_jaminan = $req->jmn;

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
        $employee->save();
        $contract->save();
        $detail->save();
        return Redirect::route('employee.index');
    }

    public function show($id)
    {
        $employee = Employee::with('relationContract', 'relationDetailed')
            ->find($id);
        return view('pages.data.employee.showEmployee', [
            'employee' => $employee
        ]);
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

    function dataDivision()
    {
        return $divison = [
            'Semua' => [
                "Accounting", "Admin", "Supplier", "Koperasi", "IT Cyber", "Freelance",
            ],
            'Food' => [
                "Soto", "Steak"
            ],
            'Aplikator' => ["Konstruksi", "Produksi"],
            'Almaas' => ["Dakwah", "Sosial", "Usaha"],
            'Express' => ["Internal", "Eksternal"]
        ];

        // $divison[] = [
        //     array(
        //         "Accounting", "Admin", "Supplier", "Koperasi", "IT Cyber", "Freelance",
        //         array("Food", "Soto", "Steak"),
        //         array("Aplikator", "Konstruksi", "Produksi"),
        //         array("Almaas", "Dakwah", "Sosial", "Usaha"),
        //         array("Express", "Internal", "Eksternal")
        //     );
        // ];
    }
}
