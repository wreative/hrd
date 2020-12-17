@extends('layouts.default')
@section('title', __('HRD BatuBeling | Tambah Karyawan'))
@section('titleContent', __('Karyawan'))
@section('breadcrumb', __('Master'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Karyawan') }}</div>
<div class="breadcrumb-item active">{{ __('Tambah Karyawan') }}</div>
@endsection

@section('content')
{{-- @if($karyawan->photo != null)
Ada
@else
Tidak Ada
asset('storage/photo/'.$karyawan->photo)
@if($karyawan->photo != null) {{ asset('storage/photo/'.$karyawan->photo) }} @else {{ asset('avatar.png') }} @endif
@endif --}}
<img alt="image" src="{{ $karyawan->photo != null ? asset('storage/photo/'.$karyawan->photo) : asset('avatar.png') }}"
    class="rounded-circle img-thumbnail mx-auto d-block" width="150px" height="150px">
<div class="card profile-widget">
    <div class="profile-widget-header">
        <div class="profile-widget-items">
            <div class="profile-widget-item">
                <div class="profile-widget-item-label">{{ __('Kode') }}</div>
                <div class="profile-widget-item-value">{{ $karyawan->kode }}</div>
            </div>
            <div class="profile-widget-item">
                <div class="profile-widget-item-label">{{ __('Status') }}</div>
                <div class="profile-widget-item-value">{{ $karyawan->status }}</div>
            </div>
            <div class="profile-widget-item">
                <div class="profile-widget-item-label">{{ __('Divisi') }}</div>
                <div class="profile-widget-item-value">{{ $karyawan->relationDetailed->divisi }}</div>
            </div>
            <div class="profile-widget-item">
                <div class="profile-widget-item-label">{{ __('Jabatan') }}</div>
                <div class="profile-widget-item-value">{{ $karyawan->relationDetailed->jabatan }}</div>
            </div>
        </div>
    </div>
    <div class="profile-widget-description pb-0 mb-5">
        <div class="profile-widget-name">{{ __('Nama') }}
            <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div> {{ $karyawan->nama }}
            </div>
        </div>
        <div class="profile-widget-name">{{ __('Lama Bekerja') }}
            <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div>
                {{ $karyawan->relationDetailed->lama_bulan . __(' Bulan') }}
            </div>
        </div>
        <div class="profile-widget-name">{{ __('NIK') }}
            <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div> {{ $karyawan->nik }}
            </div>
        </div>
        <div class="profile-widget-name">{{ __('Jenis Kelamin') }}
            <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div> {{ $karyawan->jk }}
            </div>
        </div>
        <div class="profile-widget-name">{{ __('Keterangan') }}
            <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div> {{ $karyawan->keterangan }}
            </div>
        </div>
        <div class="profile-widget-name">{{ __('Alamat') }}
            <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div> {{ $karyawan->relationDetailed->alamat }}
            </div>
        </div>
        <div class="profile-widget-name">{{ __('Kota') }}
            <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div> {{ $karyawan->relationDetailed->kota }}
            </div>
        </div>
        <div class="profile-widget-name">{{ __('Tempat Lahir') }}
            <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div> {{ $karyawan->relationDetailed->tmp_lahir }}
            </div>
        </div>
        <div class="profile-widget-name">{{ __('Tanggal Lahir') }}
            <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div> {{ date('d-m-Y',strtotime($karyawan->relationDetailed->tgl_lahir)) }}
            </div>
        </div>
        <div class="profile-widget-name">{{ __('Telepon') }}
            <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div> {{ $karyawan->relationDetailed->tlp }}
            </div>
        </div>
        <div class="profile-widget-name">{{ __('Tanggal Masuk') }}
            <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div> {{ date('d-m-Y',strtotime($karyawan->relationContract->tgl_masuk)) }}
            </div>
        </div>
        <div class="profile-widget-name">{{ __('Akhir Kontrak') }}
            <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div> {{ date('d-m-Y',strtotime($karyawan->relationContract->akhir_kontrak)) }}
            </div>
        </div>
        <div class="profile-widget-name">{{ __('No Rekening') }}
            <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div> {{ $karyawan->rek }}
            </div>
        </div>
        <div class="profile-widget-name">{{ __('Gaji') }}
            <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div> {{ __('Rp. ').number_format($karyawan->relationContract->gaji) }}
            </div>
        </div>
        <div class="profile-widget-name">{{ __('No Jaminan') }}
            <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div> {{ $karyawan->relationContract->no_jaminan }}
            </div>
        </div>
        <div class="profile-widget-name">{{ __('Jenis Jaminan') }}
            <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div> {{ $karyawan->relationContract->jenis_jaminan }}
            </div>
        </div>
    </div>
</div>
@endsection