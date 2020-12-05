<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Salary;
use App\Models\SalaryPlus;
use App\Models\SalaryMinus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SalaryController extends Controller
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
        // $salary = Salary::with('relationSalaryMinus', 'relationSalaryPlus', 'relationEmployees')->get();
        $salary = DB::table('salary')
            ->join('salary_plus', 'salary.plus_id', '=', 'salary_plus.id_plus')
            ->join('employees', 'salary.e_id', '=', 'employees.id')
            // ->join('contract', 'employees.id', '=', 'contract.id')
            ->select(
                'employees.kode',
                'employees.nama',
                'salary.tanggal',
                'salary.gaji',
                'salary_plus.lylts',
                'salary_plus.ddks',
                'salary.penerimaan',
                'salary.pengurangan',
                'salary.total'
            )
            ->get();
        return view('pages.master.gaji.gaji', ['salary' => $salary]);
    }

    public function create()
    {
        $karyawan = DB::table('employees')
            ->join('detailed', 'employees.id', '=', 'detailed.id')
            ->select('employees.id', 'divisi', 'jabatan', 'nama', 'loyalitas', 'dedikasi')
            ->get();
        return view('pages.master.gaji.createGaji', ['karyawan' => $karyawan]);
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'aktif' => 'required|max:26|min:1|numeric',
            'karyawan' => 'required',
            'tgl' => 'required|date',
            // Penambahan
            'menit' => 'required|min:0|numeric',
            'hari' => 'required|min:0|numeric',
            'llhari' => 'required|min:0|numeric',
            'lpmenit' => 'required|min:0|numeric',
            'lphari' => 'required|min:0|numeric',
            'hlkp' => 'required|min:0|numeric',
            'llkpmenit' => 'required|min:0|numeric',
            // Pengurangan
            'tpcm' => 'required|min:0|numeric',
            'haria' => 'required|min:0|numeric',
            'haris' => 'required|min:0|numeric',
            'harii' => 'required|min:0|numeric',
            'harib' => 'required|min:0|numeric',
            'ka' => 'required|min:0',
            'ik' => 'required|min:0',
            'tk' => 'required|min:0',
            't1' => 'required|min:0',
            't2' => 'required|min:0',
            't3' => 'required|min:0',
            't4' => 'required|min:0',
            'ak' => 'required|min:0',
        ]);
        // Get Name Employees
        // $karyawan = DB::table('employees')->find($req->karyawan);
        $karyawan = Employees::with('relationContract')->find($req->karyawan);
        // $hari = date('t', strtotime($req->tgl));

        // Check Loyalty And Dedication        
        if ($karyawan->loyalitas || $karyawan->dedikasi == null) {
            view('pages.master.gaji.createGaji', ['status' => 'Karyawan & Dedikasi Tidak Boleh Kosong, Tambah Terlebih Dahulu!']);
        }

        // Remove Comma        
        // $loyalitas = str_replace(',', '', $req->loyalitas);
        // $dedikasi = str_replace(',', '', $req->dedikasi);
        // $kasbonAdmin = str_replace(',', '', $req->ka);
        // $iuranKesehatan = str_replace(',', '', $req->ik);
        // $tabunganKoperasi = str_replace(',', '', $req->tk);
        // $termin1 = str_replace(',', '', $req->t1);
        // $termin2 = str_replace(',', '', $req->t2);
        // $termin3 = str_replace(',', '', $req->t3);
        // $termin4 = str_replace(',', '', $req->t4);
        // $angsuranKoperasi = str_replace(',', '', $req->ak);

        // Const
        $gajiHarian = $karyawan->relationContract->gaji / 25;
        $setengahGP = round($gajiHarian * 50) / 100;
        $transportasi = round(($setengahGP * 26.7) / 100);
        $uangHadir = round(($setengahGP * 73.333) / 100);

        // Penambahan        
        $gajiPokok = ($gajiHarian * 50 / 100) * 25;
        $uHadir = round($uangHadir * $req->aktif);
        $transport = round($transportasi * $req->aktif);
        $lmenit = round(($gajiHarian / 300) * $req->menit);
        $lhari = round($gajiHarian * $req->hari); //dsfds
        $llhari = round($gajiHarian * $req->llhari);
        $lpmenit = round(((1.25 * $gajiHarian) / 300) * $req->lpmenit);
        $lphari = round((1.25 * $gajiHarian) * $req->lphari);
        $hlkp = round((1.50 * $gajiHarian) * $req->hlkp);
        $llkpmenit = round(((1.50 * $gajiHarian) / 300) * $req->llkpmenit);

        // Pengurangan        
        $tpcm = round(($gajiHarian / 240) * $req->tpcm);
        $tha = round(($gajiHarian * 1.25) * $req->haria);
        $ths = round(($uangHadir + $transportasi) * $req->haris);
        // dd($transportasi . " " . $uangHadir . " " . $ths . " " . $req->haris);
        $thi = round(($uangHadir + $transportasi) * $req->harii);
        $thb = round($gajiHarian * $req->harib);

        // Total
        $penerimaan = round($gajiPokok +
            $uHadir +
            $transport +
            $lmenit +
            $lhari +
            $llhari +
            $lphari +
            $hlkp +
            $llkpmenit +
            $karyawan->loyalitas +
            $karyawan->dedikasi);
        $pengurangan = round($tpcm +
            $tha +
            $ths +
            $thi +
            $thb +
            $this->removeComma($req->ka) +
            $this->removeComma($req->ik) +
            $this->removeComma($req->tk) +
            $this->removeComma($req->t1) +
            $this->removeComma($req->t2) +
            $this->removeComma($req->t3) +
            $this->removeComma($req->t4) +
            $this->removeComma($req->ak));
        $total = round($penerimaan - $pengurangan);

        return redirect()->route('tempSalary')->with([
            'tgl' => $req->tgl,
            'karyawan' => $karyawan,
            // Penambahan
            'gp' => $gajiPokok,
            'trans' => $transport,
            'lmenit' => $lmenit,
            'lhari' => $lhari,
            'l' => $karyawan->loyalitas,
            'd' => $karyawan->dedikasi,
            'h' => $uHadir,
            'll' => $llhari,
            'lpm' => $lpmenit,
            'lph' => $lphari,
            'hlkp' => $hlkp,
            'llkp' => $llkpmenit,
            //Pengurangan
            'tpcm' => $tpcm,
            'tha' => $tha,
            'ths' => $ths,
            'thi' => $thi,
            'thb' => $thb,
            'ka' => $this->removeComma($req->ka),
            'ik' => $this->removeComma($req->ik),
            'tk' => $this->removeComma($req->tk),
            't1' => $this->removeComma($req->t1),
            't2' => $this->removeComma($req->t2),
            't3' => $this->removeComma($req->t3),
            't4' => $this->removeComma($req->t4),
            'ak' => $this->removeComma($req->ak),
            // Total
            'pen' => $penerimaan,
            'pengur' => $pengurangan,
            'total' => $total
        ]);
    }

    public function temp()
    {
        return view('pages.master.gaji.checkGaji');
    }

    public function check(Request $req)
    {
        $karyawan = DB::table('employees')
            ->join('contract', 'employees.kontrak', '=', 'contract.id')
            ->select('loyalitas', 'dedikasi', 'gaji', 'nama')
            ->where('employees.id', '=', $req->id)
            ->get();
        return Response()->json(['status' => 'sukses', 'karyawan' => $karyawan]);
    }

    public function input(Request $req)
    {
        $this->validate($req, [
            'karyawan' => 'required',
            'tgl' => 'required|date',
            // Penambahan
            'gp' => 'required|integer',
            'h' => 'required|integer',
            'trans' => 'required|integer',
            'lmenit' => 'required|integer',
            'lhari' => 'required|integer',
            'll' => 'required|integer',
            'lpm' => 'required|integer',
            'lph' => 'required|integer',
            'hlkp' => 'required|integer',
            'llkp' => 'required|integer',
            'l' => 'required|integer',
            'd' => 'required|integer',
            // Pengurangan
            'tpcm' => 'required|integer',
            'tha' => 'required|integer',
            'ths' => 'required|integer',
            'thi' => 'required|integer',
            'thb' => 'required|integer',
            'ka' => 'required|integer',
            'ik' => 'required|integer',
            'tk' => 'required|integer',
            't1' => 'required|integer',
            't2' => 'required|integer',
            't3' => 'required|integer',
            't4' => 'required|integer',
            'ak' => 'required|integer',
            // Total
            'pen' => 'required|integer',
            'pengur' => 'required|integer',
            'total' => 'required|integer',
        ]);

        SalaryPlus::create([
            'gaji_pkk' => $req->gp,
            'uang_hdr' => $req->h,
            'tnjgn_trpi' => $req->trans,
            'lmbr_m' => $req->lmenit,
            'lmbr_h' => $req->lhari,
            'lmbr_l' => $req->ll,
            'lmbr_p_m' => $req->lpm,
            'lmbr_p_l' => $req->lph,
            'hdr_lk' => $req->hlkp,
            'lmbr_lk' => $req->llkp,
            'lylts' => $req->l,
            'ddks' => $req->d,
        ]);

        SalaryMinus::create([
            'telat' => $req->tpcm,
            'tdk_hdr_a' => $req->tha,
            'tdk_hdr_s' => $req->ths,
            'tdk_hdr_i' => $req->thi,
            'tdk_hdr_b' => $req->thb,
            'ka' => $req->ka,
            'ik' => $req->ik,
            'tk' => $req->tk,
            't1' => $req->t1,
            't2' => $req->t2,
            't3' => $req->t3,
            't4' => $req->t4,
            'ak' => $req->ak,
        ]);

        $count = DB::table('salary_plus')->select('id_plus')->orderByDesc('id_plus')->limit('1')->first();

        Salary::create([
            'tanggal' => $req->tgl,
            'plus_id' => strval($count->id_plus),
            'minus_id' => strval($count->id_plus),
            'e_id' => $req->karyawan,
            'gaji' => $req->gaji,
            'penerimaan' => $req->pen,
            'pengurangan' => $req->pengur,
            'total' => $req->total,
        ]);

        return redirect()->route('masterSalary');
    }

    public function dataBulan()
    {
        $bulan = array(
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        return $bulan;
    }

    public function removeComma($number)
    {
        return str_replace(',', '', $number);
    }
}
