@extends('layouts.default')
@section('title', __('HRD BatuBeling | Data Karyawan'))
@section('titleContent', __('Karyawan'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Karyawan') }}</div>
@endsection

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="form-group">
            <label>{{ __('Cari Berdasarkan Apapun :') }}</label>
            <input type="text" name="name" class="form-control col-sm-4 filter_name" placeholder="Cari Disini">
        </div>
        <div class="form-group">
            <label>{{ __('Filter Berdasarkan :') }}</label>
            <select data-column="7" class="form-control selectric filter_status"
                placeholder="Filter Berdasarkan Status">
                <option value="">{{ __('Pilih Status') }}</option>
                <option value="Aktif">{{ __('Aktif') }}</option>
                <option value="Pasif">{{ __('Pasif') }}</option>
                <option value="Pelamar">{{ __('Pelamar') }}</option>
                <option value="Pending">{{ __('Pending') }}</option>
            </select>
        </div>
        <div class="form-group">
            <label>{{ __('Filter Berdasarkan Divisi :') }}</label>
            <select data-column="3" name="filter_division" class="form-control selectric" id="filter_division">
                <option value="">{{ __('Pilih Divisi') }}</option>
                <option value="Accounting" selected>{{ __('Accounting') }}</option>
                <option value="Admin">{{ __('Admin') }}</option>
                <option value="Supplier">{{ __('Supplier') }}</option>
                <option value="Koperasi">{{ __('Koperasi') }}</option>
                <option value="IT Cyber">{{ __('IT Cyber') }}</option>
                <option value="Freelance">{{ __('Freelance') }}</option>
                <optgroup label="Food"></optgroup>
                <option value="Soto">{{ __('Soto') }}</option>
                <option value="Steak">{{ __('Steak') }}</option>
                <optgroup label="Aplikator"></optgroup>
                <option value="Konstruksi">{{ __('Konstruksi') }}</option>
                <option value="Produksi">{{ __('Produksi') }}</option>
                <optgroup label="Almaas"></optgroup>
                <option value="Dakwah">{{ __('Dakwah') }}</option>
                <option value="Sosial">{{ __('Sosial') }}</option>
                <option value="Usaha">{{ __('Usaha') }}</option>
                <optgroup label="Express"></optgroup>
                <option value="Internal">{{ __('Internal') }}</option>
                <option value="Eksternal">{{ __('Eksternal') }}</option>
            </select>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <a href="{{ route('employee.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="far fa-edit"></i>{{ __(' Tambah Karyawan') }}</a>
    </div>
    <div class="card-body">
        <table class="table-striped table" id="table" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('NO') }}
                    </th>
                    <th class="text-center">
                        {{ __('Kode') }}
                    </th>
                    <th>{{ __('Nama') }}</th>
                    <th>{{ __('Divisi') }}</th>
                    <th>{{ __('Jabatan') }}</th>
                    <th>{{ __('Lama Bekerja') }}</th>
                    <th>{{ __('Gaji') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Aksi') }}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('pages/employee/indexEmployee.js') }}"></script>
@endsection