@extends('layouts.default')
@section('title', __('HRD Batubeling | Data Pengguna'))
@section('titleContent', __('Pengguna'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Pengguna') }}</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('user.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="far fa-edit"></i>{{ __(' Tambah Pengguna') }}</a>
    </div>
    <div class="card-body">
        <table class="table-striped table" id="tables" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('NO') }}
                    </th>
                    <th class="text-center">
                        {{ __('Username') }}
                    </th>
                    <th>{{ __('Nama') }}</th>
                    <th>{{ __('Hak Akses') }}</th>
                    <th>{{ __('Aksi') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $number => $u)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td class="text-center">
                        {{ $u->username }}
                    </td>
                    <td>
                        {{ $u->name }}
                    </td>
                    <td>
                        {{ $u->previleges }}
                    </td>
                    <td>
                        {{-- <form id="del-data{{ $u->id }}" action="{{ route('user.reset',$u->id) }}" method="POST"
                        class="d-inline">
                        @csrf
                        <button class="btn btn-primary btn-action mb-1 mr-1 mt-1" data-toggle="tooltip"
                            title="{{ __('Reset Password') }}"
                            data-confirm="Apakah Anda Yakin?|Aksi ini tidak 
                                dapat dikembalikan dan mengubah password menjadi default yaitu '1234567890'. Apakah ingin melanjutkan?"
                            data-confirm-yes="document.getElementById('del-data{{ $u->id }}').submit();"><i
                                class="fas fa-redo-alt"></i></button>
                        </form> --}}
                        <form id="del-data{{ $u->id }}" action="{{ route('user.destroy',$u->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-action mb-1 mt-1" data-toggle="tooltip"
                                title="{{ __('Hapus') }}" data-confirm="Apakah Anda Yakin?|Aksi ini tidak dapat 
                                dikembalikan. Apakah ingin melanjutkan?"
                                data-confirm-yes="document.getElementById('del-data{{ $u->id }}').submit();"><i
                                    class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection