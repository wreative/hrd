@extends('layouts.default')
@section('title', __('HRD BatuBeling | Master Karyawan'))
@section('titleContent', __('Karyawan'))
@section('breadcrumb', __('Master'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Karyawan') }}</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('employees.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="far fa-edit"></i>{{ __(' Tambah Karyawan') }}</a>
    </div>
    <div class="card-body">
        <table class="table-striped table" id="karyawan" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('Kode') }}
                    </th>
                    <th>{{ __('Nama') }}</th>
                    <th>{{ __('Divisi') }}</th>
                    <th>{{ __('Jabatan') }}</th>
                    <th>{{ __('Lama Bekerja') }}</th>
                    @if (Auth::user()->previleges == "Administrator")
                    <th>{{ __('Gaji') }}</th>
                    @endif
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Aksi') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($karyawan as $number => $k)
                <tr>
                    <td class="text-center">
                        {{ $k->kode }}
                    </td>
                    <td>{{ $k->nama }}</td>
                    <td>{{ $k->relationDetailed->divisi }}</td>
                    <td>{{ $k->relationDetailed->jabatan }}</td>
                    <td>{{ $k->relationDetailed->lama_bulan.__(' Bulan') }}</td>
                    @if (Auth::user()->previleges == "Administrator")
                    <td>{{ __('Rp.').number_format($k->relationContract->gaji) }}</td>
                    @endif
                    <td>
                        <span class="badge badge-info">{{ $k->status }}</span>
                    </td>
                    <td>
                        <a href="/employees/{{ $k->id }}/edit" class="btn btn-primary btn-action mb-1 mt-1 mr-1"
                            data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <a href="/employees/{{ $k->id }}" class="btn btn-info btn-action mb-1 mt-1 mr-1"
                            data-toggle="tooltip" title="Lihat Lebih Lengkap"><i class="fas fa-eye"></i></a>
                        @if (Auth::user()->previleges == "Administrator")
                        <form id="del-data" action="{{ route('employees.destroy',$k->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-action mb-1 mt-1" data-toggle="tooltip" title="Delete"
                                data-confirm="Apakah Anda Yakin?|Aksi ini tidak dapat dikembalikan. Apakah ingin melanjutkan?"
                                data-confirm-yes="document.getElementById('del-data').submit();"><i
                                    class="fas fa-trash"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('pages/karyawan/karyawan.js') }}"></script>
@endsection