@extends('layouts.default')
@section('title', __('HRD BatuBeling | Daftar Gaji'))
@section('titleContent', __('Daftar Gaji'))
@section('breadcrumb', __('Master'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Gaji') }}</div>
<div class="breadcrumb-item active">{{ __('Daftar Gaji') }}</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table-striped table" id="gaji" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('ID') }}
                    </th>
                    <th>{{ __('Nama') }}</th>
                    <th>{{ __('Tanggal') }}</th>
                    <th>{{ __('Gaji') }}</th>
                    <th>{{ __('Loyalitas') }}</th>
                    <th>{{ __('Dedikasi') }}</th>
                    <th>{{ __('Penerimaan') }}</th>
                    <th>{{ __('Pengurangan') }}</th>
                    <th>{{ __('Total') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salary as $number => $s)
                <tr>
                    <td class="text-center">
                        {{ $s->kode }}
                    </td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ date("d-M-Y", strtotime($s->tanggal)) }}</td>
                    <td>{{ __('Rp.').number_format($s->gaji) }}</td>
                    <td>{{ __('Rp.').number_format($s->lylts) }}</td>
                    <td>{{ __('Rp.').number_format($s->ddks) }}</td>
                    <td>{{ __('Rp.').number_format($s->penerimaan) }}</td>
                    <td>{{ __('Rp.').number_format($s->pengurangan) }}</td>
                    <td>{{ __('Rp.').number_format($s->total) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('pages/gaji/gaji.js') }}"></script>
@endsection