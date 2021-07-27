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
                    <th>{{ __('Tanggal') }}</th>
                    <th>{{ __('Rank') }}</th>
                    <th>{{ __('Absen') }}</th>
                    <th>{{ __('Waktu') }}</th>
                    <th>{{ __('Uniform') }}</th>
                    <th>{{ __('SOP') }}</th>
                    <th>{{ __('Tanggung Jawab') }}</th>
                    <th>{{ __('Kerja Team') }}</th>
                    <th>{{ __('Amanah') }}</th>
                    <th>{{ __('Produktif') }}</th>
                    <th>{{ __('Team Work') }}</th>
                    <th>{{ __('Loyalitas') }}</th>
                    <th>{{ __('Dedikasi') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($karyawan as $k)
                <tr>
                    <td class="text-center">
                        {{ $k->relationEmployees->kode }}
                    </td>
                    <td>{{ $k->relationEmployees->nama }}</td>
                    <td>{{ date('d-m-Y',strtotime($k->tgl)) }}</td>
                    <td>{{ $k->rank }}</td>
                    <td>{{ $k->relationLoyalty->absen.__('%') }}</td>
                    <td>{{ $k->relationLoyalty->waktu.__('%') }}</td>
                    <td>{{ $k->relationLoyalty->uniform.__('%') }}</td>
                    <td>{{ $k->relationLoyalty->sop.__('%') }}</td>
                    <td>{{ $k->relationLoyalty->tj.__('%') }}</td>
                    <td>{{ $k->relationLoyalty->kt.__('%') }}</td>
                    <td>{{ $k->relationDedication->amanah.__('%') }}</td>
                    <td>{{ $k->relationDedication->produktif.__('%') }}</td>
                    <td>{{ $k->relationDedication->tw.__('%') }}</td>
                    <td>{{ __('Rp.').number_format($k->relationLoyalty->total) }}</td>
                    <td>{{ __('Rp.').number_format($k->relationDedication->total) }}</td>
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