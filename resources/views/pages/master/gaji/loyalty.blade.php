@extends('layouts.default')
@section('title', __('HRD BatuBeling | Daftar Loyalitas & Dedikasi'))
@section('titleContent', __('Daftar Loyalitas & Dedikasi'))
@section('breadcrumb', __('Master'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Gaji') }}</div>
<div class="breadcrumb-item active">{{ __('Daftar Loyalitas & Dedikasi') }}</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table-striped table" id="loyalty" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('ID') }}
                    </th>
                    <th>{{ __('Nama') }}</th>
                    <th>{{ __('Dedikasi') }}</th>
                    <th>{{ __('Loyalty') }}</th>
                    <th>{{ __('Gaji Pokok') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($karyawan as $k)
                <tr>
                    <td class="text-center">
                        {{ $k->kode }}
                    </td>
                    <td>{{ $k->nama }}</td>
                    <td>{{ __('Rp.').number_format($k->dedikasi) }}</td>
                    <td>{{ __('Rp.').number_format($k->loyalitas) }}</td>
                    {{-- <td>{{ __('Rp.').number_format($k->relationContract->gaji) }}</td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('pages/gaji/loyalty.js') }}"></script>
@endsection