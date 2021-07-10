@extends('layouts.default')
@section('title', __('HRD BatuBeling | Edit Karyawan'))
@section('titleContent', __('Edit Karyawan'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Karyawan') }}</div>
<div class="breadcrumb-item active">{{ __('Edit Karyawan') }}</div>
@endsection

@section('content')
<h2 class="section-title">{{ $employee->kode }}</h2>
<p class="section-lead">
    {{ __('ID yang digunakan untuk mengidentifikasi setiap karyawan pada perusahaan.') }}
</p>
<div class="card">
    <form method="POST" action="{{ route('employee.update',$employee->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('NIK (16 Digit)') }}<code>*</code></label>
                        <input type="text" class="form-control nik @error('nik') is-invalid @enderror" name="nik"
                            value="{{ $employee->nik }}" required autofocus>
                        @error('nik')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Lama Bekerja') }}</label>
                        <div class="input-group">
                            <input class="form-control @error('lb') is-invalid @enderror" type="number"
                                value="{{ $employee->relationDetailed->lama_bulan }}" name="lb">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Bulan') }}
                                </div>
                            </div>
                        </div>
                        @error('lb')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Divisi') }}<code>*</code></label>
                        <select class="custom-select selectric @error('divisi') is-invalid @enderror" name="divisi"
                            required>
                            <option value="Accounting"
                                {{ $employee->relationDetailed->divisi == 'Accounting' ? 'selected' : '' }}>
                                {{ __('Accounting') }}
                            </option>
                            <option value="Admin"
                                {{ $employee->relationDetailed->divisi == 'Admin' ? 'selected' : '' }}>
                                {{ __('Admin') }}
                            </option>
                            <option value="Supplier"
                                {{ $employee->relationDetailed->divisi == 'Supplier' ? 'selected' : '' }}>
                                {{ __('Supplier') }}
                            </option>
                            <option value="Koperasi"
                                {{ $employee->relationDetailed->divisi == 'Koperasi' ? 'selected' : '' }}>
                                {{ __('Koperasi') }}
                            </option>
                            <option value="IT Cyber"
                                {{ $employee->relationDetailed->divisi == 'IT Cyber' ? 'selected' : '' }}>
                                {{ __('IT Cyber') }}
                            </option>
                            <option value="Freelance"
                                {{ $employee->relationDetailed->divisi == 'Freelance' ? 'selected' : '' }}>
                                {{ __('Freelance') }}
                            </option>
                            <optgroup label="Food"></optgroup>
                            <option value="Soto" {{ $employee->relationDetailed->divisi == 'Soto' ? 'selected' : '' }}>
                                {{ __('Soto') }}
                            </option>
                            <option value="Steak"
                                {{ $employee->relationDetailed->divisi == 'Steak' ? 'selected' : '' }}>
                                {{ __('Steak') }}
                            </option>
                            <optgroup label="Aplikator"></optgroup>
                            <option value="Konstruksi"
                                {{ $employee->relationDetailed->divisi == 'Konstruksi' ? 'selected' : '' }}>
                                {{ __('Konstruksi') }}
                            </option>
                            <option value="Produksi"
                                {{ $employee->relationDetailed->divisi == 'Produksi' ? 'selected' : '' }}>
                                {{ __('Produksi') }}
                            </option>
                            <optgroup label="Almaas"></optgroup>
                            <option value="Dakwah"
                                {{ $employee->relationDetailed->divisi == 'Dakwah' ? 'selected' : '' }}>
                                {{ __('Dakwah') }}
                            </option>
                            <option value="Sosial"
                                {{ $employee->relationDetailed->divisi == 'Sosial' ? 'selected' : '' }}>
                                {{ __('Sosial') }}
                            </option>
                            <option value="Usaha"
                                {{ $employee->relationDetailed->divisi == 'Usaha' ? 'selected' : '' }}>
                                {{ __('Usaha') }}
                            </option>
                            <optgroup label="Express"></optgroup>
                            <option value="Internal"
                                {{ $employee->relationDetailed->divisi == 'Internal' ? 'selected' : '' }}>
                                {{ __('Internal') }}
                            </option>
                            <option value="Eksternal"
                                {{ $employee->relationDetailed->divisi == 'Eksternal' ? 'selected' : '' }}>
                                {{ __('Eksternal') }}
                            </option>
                        </select>
                        @error('divisi')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Tanggal Masuk') }}<code>*</code></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="far fa-calendar"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker @error('masuk') is-invalid @enderror"
                                name="masuk" value="{{ $employee->relationContract->tgl_masuk }}" required>
                            @error('masuk')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Gaji') }}<code>*</code></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Rp.') }}
                                </div>
                            </div>
                            <input class="form-control currency @error('gaji') is-invalid @enderror"
                                value="{{ $employee->relationContract->gaji }}" type="text" name="gaji" required>
                        </div>
                        @error('gaji')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                        @if (Session::has('status'))
                        <span class="text-danger" role="alert">
                            {{ Session::get('status') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{ __('No Jaminan') }}</label>
                        <input type="text" class="form-control text-uppercase @error('no_jmn') is-invalid @enderror"
                            value="{{ $employee->relationContract->no_jaminan }}" name="no_jmn">
                        @error('no_jmn')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Alamat') }}<code>*</code></label>
                        <input type="text" class="form-control @error('alm') is-invalid @enderror"
                            value="{{ $employee->relationDetailed->alamat }}" name="alm" required>
                        @error('alm')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Tempat Lahir') }}<code>*</code></label>
                        <input type="text" class="form-control @error('tmp_lahir') is-invalid @enderror"
                            name="tmp_lahir" value="{{ $employee->relationDetailed->tmp_lahir }}" required>
                        @error('tmp_lahir')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('No HP') }}<code>*</code></label>
                        <input type="text" class="form-control tlp @error('tlp') is-invalid @enderror" name="tlp"
                            value="{{ $employee->relationDetailed->tlp }}" required>
                        @error('tlp')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Nama Lengkap') }}<code>*</code></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $employee->nama }}" required>
                        @error('name')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Jenis Kelamin') }}<code>*</code></label>
                        <select class="custom-select selectric @error('jk') is-invalid @enderror" name="jk" required>
                            <option value="Laki-Laki" {{ $employee->jk == 'Laki-Laki' ? 'selected' : '' }}>
                                {{ __('Laki-Laki') }}
                            </option>
                            <option value="Perempuan" {{ $employee->jk == 'Perempuan' ? 'selected' : '' }}>
                                {{ __('Perempuan') }}
                            </option>
                        </select>
                        @error('jk')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Jabatan') }}<code>*</code></label>
                        <select class="custom-select selectric @error('jabatan') is-invalid @enderror" name="jabatan"
                            required>
                            @foreach ($position as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('jabatan')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Akhir Kontrak') }}<code>*</code></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="far fa-calendar"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker @error('kontrak') is-invalid @enderror"
                                name="kontrak" value="{{ $employee->relationContract->akhir_kontrak }}" required>
                            @error('kontrak')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('No Rekening') }}</label>
                        <input type="text" class="form-control text-uppercase @error('rek') is-invalid @enderror"
                            value="{{ $employee->rek }}" name="rek">
                        @error('rek')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Jenis Jaminan') }}</label>
                        <input type="text" class="form-control text-uppercase @error('jmn') is-invalid @enderror"
                            value="{{ $employee->relationContract->jenis_jaminan }}" name="jmn">
                        @error('jmn')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Kota') }}<code>*</code></label>
                        <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota"
                            value="{{ $employee->relationDetailed->kota }}" required>
                        @error('kota')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Tanggal Lahir') }}<code>*</code></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="far fa-calendar"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker @error('tgl_lahir') is-invalid @enderror"
                                value="{{ $employee->relationDetailed->tgl_lahir }}" name="tgl_lahir" required>
                            @error('tgl_lahir')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Status') }}<code>*</code></label>
                        <select class="custom-select selectric @error('status') is-invalid @enderror" name="status"
                            required>
                            <option value="Aktif" {{ $employee->status == 'Aktif' ? 'selected' : '' }}>
                                {{ __('Aktif') }}
                            </option>
                            <option value="Pasif" {{ $employee->status == 'Pasif' ? 'selected' : '' }}>
                                {{ __('Pasif') }}
                            </option>
                            <option value="Pelamar" {{ $employee->status == 'Pelamar' ? 'selected' : '' }}>
                                {{ __('Pelamar') }}
                            </option>
                            <option value="Pending" {{ $employee->status == 'Pending' ? 'selected' : '' }}>
                                {{ __('Pending') }}
                            </option>
                            <option value="Cancel" {{ $employee->status == 'Cancel' ? 'selected' : '' }}>
                                {{ __('Cancel') }}
                            </option>
                        </select>
                        @error('status')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('Foto') }}</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="foto"
                        accept="image/png, image/jpeg, image/jpg, image/svg" id="foto">
                    <label class="custom-file-label" for="foto" id="foto_label">{{ __('Pilih File') }}</label>
                </div>
                @error('foto')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>{{ __('Keterangan') }}</label>
                <textarea type="text" class="form-control @error('ket') is-invalid @enderror" name="ket"
                    style="height: 100px !important">
                    {{ $employee->keterangan }}
                </textarea>
                @error('ket')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">{{ __('Ubah Data') }}</button>
        </div>
    </form>
</div>
@endsection
@section('script')
<script src="{{ asset('pages/karyawan/createKaryawan.js') }}"></script>
@endsection