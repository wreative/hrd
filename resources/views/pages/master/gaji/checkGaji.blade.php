@extends('layouts.default')
@section('title', __('HRD BatuBeling | Cek Data Gaji'))
@section('titleContent', __('Cek Data Gaji'))
@section('breadcrumb', __('Master'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Gaji') }}</div>
<div class="breadcrumb-item active">{{ __('Tambah Data Gaji') }}</div>
<div class="breadcrumb-item active">{{ __('Cek Gaji') }}</div>
@endsection

@section('content')
@if(Session::get('karyawan')!= null)
<h2 class="section-title">{{ Session::get('karyawan')->nama }}</h2>
<p class="section-lead">
    {{ __('ID Karyawan ').Session::get('karyawan')->kode.__(' dengan slip gaji bulan ').date("d-M-Y", strtotime(Session::get('tgl')))}}
</p>
<div class="card">
    <form method="POST" action="{{ route('inputSalary') }}">
        @csrf
        <input type="hidden" value="{{ Session::get('karyawan')->id }}" name="karyawan">
        <input type="hidden" value="{{ Session::get('karyawan')->relationContract->gaji }}" name="gaji">
        <input type="hidden" value="{{ Session::get('tgl') }}" name="tgl">
        <div class="card-body table-responsive">
            <div class="section-title mt-0">{{ __('Penerimaan') }}</div>
            <table class="table-hover table">
                <thead>
                    <tr>
                        <th>{{ __('Nama') }}</th>
                        <th class="text-right">{{ __('Nominal') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{ __('Gaji Pokok') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('gp')) }}</td>
                        <input type="hidden" value="{{ Session::get('gp') }}" name="gp">
                    </tr>
                    <tr>
                        <th>{{ __('Uang Hadir') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('h')) }}</td>
                        <input type="hidden" value="{{ Session::get('h') }}" name="h">
                    </tr>
                    <tr>
                        <th>{{ __('Tunjangan Transportasi') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('trans')) }}</td>
                        <input type="hidden" value="{{ Session::get('trans') }}" name="trans">
                    </tr>
                    <tr>
                        <th>{{ __('Lembur/Menit') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('lmenit')) }}</td>
                        <input type="hidden" value="{{ Session::get('lmenit') }}" name="lmenit">
                    </tr>
                    <tr>
                        <th>{{ __('Lembur/Hari') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('lhari')) }}</td>
                        <input type="hidden" value="{{ Session::get('lhari') }}" name="lhari">
                    </tr>
                    <tr>
                        <th>{{ __('Lembur Libur') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('ll')) }}</td>
                        <input type="hidden" value="{{ Session::get('ll') }}" name="ll">
                    </tr>
                    <tr>
                        <th>{{ __('Lembur Proyek/Menit') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('lpm')) }}</td>
                        <input type="hidden" value="{{ Session::get('lpm') }}" name="lpm">
                    </tr>
                    <tr>
                        <th>{{ __('Lembur Proyek/Libur') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('lph')) }}</td>
                        <input type="hidden" value="{{ Session::get('lph') }}" name="lph">
                    </tr>
                    <tr>
                        <th>{{ __('Hadir Luar Kota/Pulau') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('hlkp')) }}</td>
                        <input type="hidden" value="{{ Session::get('hlkp') }}" name="hlkp">
                    </tr>
                    <tr>
                        <th>{{ __('Lembur/Menit Luar Kota atau Pulau') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('llkp')) }}</td>
                        <input type="hidden" value="{{ Session::get('llkp') }}" name="llkp">
                    </tr>
                    <tr>
                        <th>{{ __('Loyalitas') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('l')) }}</td>
                        <input type="hidden" value="{{ Session::get('l') }}" name="l">
                    </tr>
                    <tr>
                        <th>{{ __('Dedikasi') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('d')) }}</td>
                        <input type="hidden" value="{{ Session::get('d') }}" name="d">
                    </tr>
                </tbody>
            </table>
            <div class="section-title mt-0">{{ __('Pengurangan') }}</div>
            <table class="table-hover table">
                <thead>
                    <tr>
                        <th>{{ __('Nama') }}</th>
                        <th class="text-right">{{ __('Nominal') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{ __('Terlambat atau Pulang Cepat/Menit') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('tpcm')) }}</td>
                        <input type="hidden" value="{{ Session::get('tpcm') }}" name="tpcm">
                    </tr>
                    <tr>
                        <th>{{ __('Tidak Hadir (A)') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('tha')) }}</td>
                        <input type="hidden" value="{{ Session::get('tha') }}" name="tha">
                    </tr>
                    <tr>
                        <th>{{ __('Tidak Hadir (S)') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('ths')) }}</td>
                        <input type="hidden" value="{{ Session::get('ths') }}" name="ths">
                    </tr>
                    <tr>
                        <th>{{ __('Tidak Hadir (I)') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('thi')) }}</td>
                        <input type="hidden" value="{{ Session::get('thi') }}" name="thi">
                    </tr>
                    <tr>
                        <th>{{ __('Tidak Hadir (B)') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('thb')) }}</td>
                        <input type="hidden" value="{{ Session::get('thb') }}" name="thb">
                    </tr>
                    <tr>
                        <th>{{ __('Kasbon Admin') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('ka')) }}</td>
                        <input type="hidden" value="{{ Session::get('ka') }}" name="ka">
                    </tr>
                    <tr>
                        <th>{{ __('Iuran Kesehatan') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('ik')) }}</td>
                        <input type="hidden" value="{{ Session::get('ik') }}" name="ik">
                    </tr>
                    <tr>
                        <th>{{ __('Tabungan Koperasi') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('tk')) }}</td>
                        <input type="hidden" value="{{ Session::get('tk') }}" name="tk">
                    </tr>
                    <tr>
                        <th>{{ __('Termin 1') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('t1')) }}</td>
                        <input type="hidden" value="{{ Session::get('t1') }}" name="t1">
                    </tr>
                    <tr>
                        <th>{{ __('Termin 2') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('t2')) }}</td>
                        <input type="hidden" value="{{ Session::get('t2') }}" name="t2">
                    </tr>
                    <tr>
                        <th>{{ __('Termin 3') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('t3')) }}</td>
                        <input type="hidden" value="{{ Session::get('t3') }}" name="t3">
                    </tr>
                    <tr>
                        <th>{{ __('Termin 4') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('t4')) }}</td>
                        <input type="hidden" value="{{ Session::get('t4') }}" name="t4">
                    </tr>
                    <tr>
                        <th>{{ __('Angsuran Koperasi') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('ak')) }}</td>
                        <input type="hidden" value="{{ Session::get('ak') }}" name="ak">
                    </tr>
                </tbody>
            </table>
            <div class="section-title mt-0">{{ __('Total') }}</div>
            <table class="table-hover table">
                <thead>
                    <tr>
                        <th>{{ __('Nama') }}</th>
                        <th class="text-right">{{ __('Nominal') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{ __('Penerimaan') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('pen')) }}</td>
                        <input type="hidden" value="{{ Session::get('pen') }}" name="pen">
                    </tr>
                    <tr>
                        <th>{{ __('Pengurangan') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('pengur')) }}</td>
                        <input type="hidden" value="{{ Session::get('pengur') }}" name="pengur">
                    </tr>
                    <tr>
                        <th>{{ __('TOTAL YANG DITERIMA KARYAWAN') }}</th>
                        <td class="text-right">{{ __('Rp. ').number_format(Session::get('total')) }}</td>
                        <input type="hidden" value="{{ Session::get('total') }}" name="total">
                    </tr>
                </tbody>
            </table>
            <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" type="submit">{{ __('Tambah Gaji Bulan Ini') }}</button>
            </div>
    </form>
</div>
@else
<div class="card">
    <div class="card-body text-center">
        <h3 class="mt-4">
            {{ __('Data Tidak Ada') }}
        </h3>
        <p class="lead mt-4">
            {{ __('Tambahkan Gaji Karyawan Terlebih Dahulu') }}
        </p>
        <a href="{{ route('createSalary') }}" class="btn btn-outline-primary">{{ __('Tambah Gaji Karyawan') }}</a>
    </div>
</div>
@endif
@endsection