<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Detailed;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

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
    public function index(Request $req)
    {
        if ($req->ajax()) {
            $data = DB::table('employee')
                ->select(
                    'employee.id AS id',
                    'employee.kode AS code',
                    'employee.nama AS name',
                    'detailed.divisi AS division',
                    'detailed.jabatan AS position',
                    'detailed.lama_bulan AS long_month',
                    'contract.gaji AS salary',
                    'employee.status'
                )
                ->join('contract', 'employee.kontrak', '=', 'contract.id')
                ->join('detailed', 'employee.detail', '=', 'detailed.id')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('long_month', function ($row) {
                    return $row->long_month . __(' Bulan');
                })
                ->addColumn('salary', function ($row) {
                    if (Auth::user()->previleges == "Administrator") {
                        return __('Rp.') . number_format($row->salary);
                    } else {
                        return __('Hidden');
                    }
                })
                ->addColumn('status', function ($row) {
                    $status = '<span class="badge badge-info">' . $row->status . '</span>';
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="btn-group">';
                    $actionBtn .= '<a href="' . route('employee.show', $row->id) . '" class="btn btn-primary">Lihat</a>';
                    $actionBtn .= '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                            data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>';
                    $actionBtn .= '<div class="dropdown-menu">
                            <a class="dropdown-item" href="' . route('employee.edit', $row->id) . '">Edit</a>';
                    if (Auth::user()->previleges == "Administrator") {
                        $actionBtn .= '<a onclick="del(' . $row->id . ')" class="dropdown-item" style="cursor:pointer;">Hapus</a>';
                    }
                    $actionBtn .= '</div></div>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'long_month', 'salary'])
                ->make(true);
        }

        return view('pages.data.employee.indexEmployee');
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
        Contract::destroy($employee->kontrak);
        Detailed::destroy($employee->detail);
        if (Storage::disk('public')->exists($employee->photo)) {
            Storage::disk('public')->delete($employee->photo);
        }
        $employee->delete();
        return Response::json(['status' => 'success']);
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

        // Stored Employee
        Employee::where('id', $id)
            ->update([
                'nik' => $req->nik,
                'nama' => $req->name,
                'jk' => $req->jk,
                'status' => $req->status,
                'keterangan' => $req->ket,
                'rek' => $req->rek
            ]);

        // Find ID
        $employee = Employee::find($id);

        // Stored Contract
        Contract::where('id', $employee->kontrak)
            ->update([
                'tgl_masuk' => $req->masuk,
                'akhir_kontrak' => $req->kontrak,
                'gaji' => str_replace(',', '', $req->gaji),
                'no_jaminan' => $req->no_jmn,
                'jenis_jaminan' => $req->jmn,
            ]);

        // Stored Detailed
        Detailed::where('id', $employee->detail)
            ->update([
                'divisi' => $req->divisi,
                'jabatan' => $req->jabatan,
                'alamat' => $req->alm,
                'kota' => $req->kota,
                'tmp_lahir' => $req->tmp_lahir,
                'tgl_lahir' => $req->tgl_lahir,
                'tlp' => $req->tlp,
                'lama_bulan' => $req->lb
            ]);

        return Redirect::route('employee.index');
    }

    public function show($id)
    {
        $employee = Employee::with('relationContract', 'relationDetailed')
            ->find($id);
        return view('pages.data.employee.showEmployee', [
            'employee' => $employee,
            'position' => Position::all()
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
}
