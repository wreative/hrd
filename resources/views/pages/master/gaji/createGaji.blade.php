@extends('layouts.default')
@section('title', __('HRD BatuBeling | Tambah Data Gaji'))
@section('titleContent', __('Tambah Data Gaji'))
@section('breadcrumb', __('Master'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Gaji') }}</div>
<div class="breadcrumb-item active">{{ __('Tambah Data Gaji') }}</div>
@endsection

@section('content')
@isset($status)
<div class="alert alert-danger alert-has-icon">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
    <div class="alert-body">
        <div class="alert-title">{{ __('Informasi') }}</div>
        {{ $status }}
    </div>
</div>
@endisset
<form method="POST" action="{{ route('storeSalary') }}" id="data">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label>{{ __('Karyawan') }}<code>*</code></label>
                <select class="custom-select select2 @error('karyawan') is-invalid @enderror" name="karyawan"
                    id="karyawan">
                    @foreach ($karyawan as $k)
                    <option value="{{ $k->id }}">
                        {{ $k->nama." - ".$k->jabatan." ".$k->divisi }}</option>
                    @endforeach
                </select>
                @error('karyawan')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>{{ __('Tanggal') }}<code>*</code></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="far fa-calendar"></i>
                        </div>
                    </div>
                    <input type="text" class="form-control datepicker @error('tgl') is-invalid @enderror" name="tgl"
                        required>
                    @error('tgl')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('Jumlah Hari Karyawan Aktif') }}<code>*</code></label>
                <div class="input-group">
                    <input class="form-control @error('aktif') is-invalid @enderror" type="number" max="26"
                        placeholder="Maksimal Hari Masuk 26" name="aktif" required autofocus>
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{ __('Hari') }}
                        </div>
                    </div>
                </div>
                @error('aktif')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        @if($karyawan->count() != 0)
        <div class="card-footer text-right">
            <a class="btn btn-info btn-action mr-1" data-toggle="tooltip"
                title="Lihat data Gaji, Dedikasi dan Loyalitas" style="cursor: pointer"
                onclick="check()">{{ __('Lihat Data Sebelumnya') }}</a>
            <button class="btn btn-primary mr-1" type="submit">{{ __('Cek Gaji') }}</button>
        </div>
        @endif
    </div>
    <h2 class="section-title">{{ __('Catatan') }}</h2>
    <p class="section-lead">
        {{ __('Jika kosong atau tidak ada, isikan nilai 0') }}
    </p>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Penerimaan') }}</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>{{ __('Lembur Per Menit') }} </label>
                        <div class="input-group">
                            <input class="form-control @error('menit') is-invalid @enderror" value="0" type="number"
                                name="menit" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Menit') }}
                                </div>
                            </div>
                        </div>
                        @error('menit')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Lembur Per Hari') }} </label>
                        <div class="input-group">
                            <input class="form-control @error('hari') is-invalid @enderror" value="0" type="number"
                                name="hari" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Hari') }}
                                </div>
                            </div>
                        </div>
                        @error('hari')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Lembur Libur Per Hari') }} </label>
                        <div class="input-group">
                            <input class="form-control @error('llhari') is-invalid @enderror" value="0" type="number"
                                name="llhari" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Hari') }}
                                </div>
                            </div>
                        </div>
                        @error('llhari')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Lembur Proyek Per Menit') }} </label>
                        <div class="input-group">
                            <input class="form-control @error('lpmenit') is-invalid @enderror" value="0" type="number"
                                name="lpmenit" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Menit') }}
                                </div>
                            </div>
                        </div>
                        @error('lpmenit')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Lembur Proyek Per Hari') }} </label>
                        <div class="input-group">
                            <input class="form-control @error('lphari') is-invalid @enderror" value="0" type="number"
                                name="lphari" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Hari') }}
                                </div>
                            </div>
                        </div>
                        @error('lphari')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Hadir Luar Kota atau Pulau') }} </label>
                        <div class="input-group">
                            <input class="form-control @error('hlkp') is-invalid @enderror" value="0" type="number"
                                name="hlkp" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Hari') }}
                                </div>
                            </div>
                        </div>
                        @error('hlkp')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Lembur Luar Kota atau Pulau Per Menit') }} </label>
                        <div class="input-group">
                            <input class="form-control @error('llkpmenit') is-invalid @enderror" value="0" type="number"
                                name="llkpmenit" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Menit') }}
                                </div>
                            </div>
                        </div>
                        @error('llkpmenit')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Pengurangan') }}</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>{{ __('Terlambat atau Pulang Cepat Per Menit') }}</label>
                        <div class="input-group">
                            <input class="form-control @error('tpcm') is-invalid @enderror" value="0" type="number"
                                name="tpcm" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Menit') }}
                                </div>
                            </div>
                        </div>
                        @error('tpcm')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Tidak Hadir (A)') }}</label>
                        <div class="input-group">
                            <input class="form-control @error('haria') is-invalid @enderror" value="0" type="number"
                                name="haria" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Hari') }}
                                </div>
                            </div>
                        </div>
                        @error('haria')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Tidak Hadir (S)') }}</label>
                        <div class="input-group">
                            <input class="form-control @error('haris') is-invalid @enderror" value="0" type="number"
                                name="haris" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Hari') }}
                                </div>
                            </div>
                        </div>
                        @error('haris')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Tidak Hadir (I)') }}</label>
                        <div class="input-group">
                            <input class="form-control @error('harii') is-invalid @enderror" value="0" type="number"
                                name="harii" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Hari') }}
                                </div>
                            </div>
                        </div>
                        @error('harii')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Tidak Hadir (B)') }}</label>
                        <div class="input-group">
                            <input class="form-control @error('harib') is-invalid @enderror" value="0" type="number"
                                name="harib" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Hari') }}
                                </div>
                            </div>
                        </div>
                        @error('harib')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Kasbon Admin') }} </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Rp.') }}
                                </div>
                            </div>
                            <input class="form-control currency @error('ka') is-invalid @enderror" value="0" type="text"
                                name="ka" required>
                        </div>
                        @error('ka')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Iuran Kesehatan') }} </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Rp.') }}
                                </div>
                            </div>
                            <input class="form-control currency @error('ik') is-invalid @enderror" value="0" type="text"
                                name="ik" required>
                        </div>
                        @error('ik')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Tabungan Koperasi') }} </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Rp.') }}
                                </div>
                            </div>
                            <input class="form-control currency @error('tk') is-invalid @enderror" value="0" type="text"
                                name="tk" required>
                        </div>
                        @error('tk')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Termin') }} </label>
                        <div class="input-group">
                            <input type="text" name="t1" placeholder="Ke I" class="currency form-control" required>
                            <input type="text" name="t2" placeholder="Ke II" class="currency form-control" required>
                            <input type="text" name="t3" placeholder="Ke III" class="currency form-control" required>
                            <input type="text" name="t4" placeholder="Ke IV" class="currency form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Angsuran Koperasi') }} </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Rp.') }}
                                </div>
                            </div>
                            <input class="form-control currency @error('ak') is-invalid @enderror" value="0" type="text"
                                name="ak" required>
                        </div>
                        @error('ak')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('script')
<script src="{{ asset('pages/gaji/createGaji.js') }}"></script>
@endsection