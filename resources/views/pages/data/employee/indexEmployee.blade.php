@extends('layouts.default')
@section('title', __('HRD BatuBeling | Data Karyawan'))
@section('titleContent', __('Karyawan'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Karyawan') }}</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('employee.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="far fa-edit"></i>{{ __(' Tambah Karyawan') }}</a>
    </div>
    <div class="card-body">
        <table class="table-striped table" id="tables" width="100%">
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
                    @if (Auth::user()->previleges == "Administrator")
                    <th>{{ __('Gaji') }}</th>
                    @endif
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Aksi') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employee as $number => $e)
                <tr>
                    <td class="text-center">
                        {{ $e->number + 1 }}
                    </td>
                    <td class="text-center">
                        {{ $e->kode }}
                    </td>
                    <td>{{ $e->nama }}</td>
                    <td>{{ $e->relationDetailed->divisi }}</td>
                    <td>{{ $e->relationDetailed->jabatan }}</td>
                    <td>{{ $e->relationDetailed->lama_bulan.__(' Bulan') }}</td>
                    @if (Auth::user()->previleges == "Administrator")
                    <td>{{ __('Rp.').number_format($e->relationContract->gaji) }}</td>
                    @endif
                    <td>
                        <span class="badge badge-info">{{ $e->status }}</span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('employee.show',$e->id) }}" class="btn btn-primary">{{ __('Lihat') }}</a>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown">
                                <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('employee.edit',$e->id) }}">{{ __('Edit') }}</a>
                                @if (Auth::user()->previleges == "Administrator")
                                <form id="del-data{{ $e->id }}" action="{{ route('employee.destroy',$e->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <a class="dropdown-item" style="cursor: pointer"
                                        data-confirm="Apakah Anda Yakin?|Aksi ini tidak dapat dikembalikan. Apakah ingin melanjutkan?"
                                        data-confirm-yes="document.getElementById('del-data{{ $e->id }}').submit();">
                                        {{ __('Hapus') }}
                                    </a>
                                </form>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection