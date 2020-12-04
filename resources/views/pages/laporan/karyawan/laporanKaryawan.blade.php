@extends('layouts.default')
@section('title', __('HRD BatuBeling | Laporan Karyawan'))
@section('titleContent', __('Laporan Karyawan'))
@section('breadcrumb', __('Laporan'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Karyawan') }}</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        {{-- <div class="table-responsive"> --}}
        <table class="table-striped table" id="lkaryawan" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('#') }}
                    </th>
                    <th>{{ __('NIK') }}</th>
                    <th>{{ __('Kode') }}</th>
                    <th>{{ __('Nama') }}</th>
                    <th>{{ __('Jenis Kelamin') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Keterangan') }}</th>
                    <th>{{ __('Divisi') }}</th>
                    <th>{{ __('Jabatan') }}</th>
                    <th>{{ __('Alamat') }}</th>
                    <th>{{ __('Kota') }}</th>
                    <th>{{ __('Tempat Lahir') }}</th>
                    <th>{{ __('Tanggal Lahir') }}</th>
                    <th>{{ __('Telepon') }}</th>
                    <th>{{ __('Tanggal Masuk') }}</th>
                    <th>{{ __('Akhir Kontrak') }}</th>
                    <th>{{ __('Gaji') }}</th>
                    <th>{{ __('No Jaminan') }}</th>
                    <th>{{ __('Jenis Jaminan') }}</th>
                    <th>{{ __('Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($karyawan as $number => $k)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td>{{ $k->nik }}</td>
                    <td>{{ $k->kode }}</td>
                    <td>{{ $k->nama }}</td>
                    <td>{{ $k->jk }}</td>
                    <td>{{ $k->status }}</td>
                    <td>{{ $k->keterangan }}</td>
                    <td>{{ $k->relationDetailed->divisi }}</td>
                    <td>{{ $k->relationDetailed->jabatan }}</td>
                    <td>{{ $k->relationDetailed->alamat }}</td>
                    <td>{{ $k->relationDetailed->kota }}</td>
                    <td>{{ $k->relationDetailed->tmp_lahir }}</td>
                    <td>{{ $k->relationDetailed->tgl_lahir }}</td>
                    <td>{{ $k->relationDetailed->tlp }}</td>
                    <td>{{ $k->relationContract->tgl_masuk }}</td>
                    <td>{{ $k->relationContract->akhir_kontrak }}</td>
                    <td>{{ $k->relationContract->gaji }}</td>
                    <td>{{ $k->relationContract->no_jaminan }}</td>
                    <td>{{ $k->relationContract->jenis_jaminan }}</td>
                    <td>
                        <span class="badge badge-info">{{ $k->status }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- </div> --}}
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('pages/laporan/karyawan.js') }}"></script>
@endsection