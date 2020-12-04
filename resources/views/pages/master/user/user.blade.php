@extends('layouts.default')
@section('title', __('HRD BatuBeling | Master User'))
@section('titleContent', __('User'))
@section('breadcrumb', __('Master'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('User') }}</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('createUser') }}" class="btn btn-icon icon-left btn-primary">
            <i class="far fa-edit"></i>{{ __(' Tambah User') }}</a>
    </div>
    <div class="card-body">
        {{-- <div class="table-responsive"> --}}
        <table class="table-striped table" id="user" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('#') }}
                    </th>
                    <th>{{ __('Nama') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Role User') }}</th>
                    <th>{{ __('Aksi') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $number => $u)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <span class="badge badge-info">{{ $u->previleges }}</span>
                    </td>
                    <td>
                        <a class="btn btn-danger btn-action" style="cursor: pointer" data-toggle="tooltip"
                            title="Delete"
                            data-confirm="Apakah Anda Yakin?|Aksi ini tidak dapat dikembalikan. Apakah ingin melanjutkan?"
                            data-confirm-yes="window.open('/user/delete/{{ $u->id }}','_self')"><i
                                class="fas fa-trash"></i></a>
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
<script src="{{ asset('pages/user/user.js') }}"></script>
@endsection