@extends('layouts.default')
@section('title', __('HRD BatuBeling | Loyalitas & Dedikasi'))
@section('titleContent', __('Loyalitas & Dedikasi'))
@section('breadcrumb', __('Master'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Gaji') }}</div>
<div class="breadcrumb-item active">{{ __('Loyalitas & Dedikasi') }}</div>
@endsection

@section('content')
<form method="POST" action="{{ route('storeLoyalty') }}">
    @csrf
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Loyalitas') }}</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>{{ __('Absen') }}<code>*</code></label>
                        <div class="input-group">
                            <input class="form-control @error('absen') is-invalid @enderror" type="number" id="absen"
                                name="absen" required placeholder="Maksimal 20" max="20" autofocus>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('%') }}
                                </div>
                            </div>
                        </div>
                        @error('absen')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Waktu') }}<code>*</code></label>
                        <div class="input-group">
                            <input class="form-control @error('waktu') is-invalid @enderror" id="waktu" type="number"
                                name="waktu" required placeholder="Maksimal 10" max="10">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('%') }}
                                </div>
                            </div>
                        </div>
                        @error('waktu')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Uniform') }}<code>*</code></label>
                        <div class="input-group">
                            <input class="form-control @error('uniform') is-invalid @enderror" id="uniform"
                                type="number" name="uniform" required placeholder="Maksimal 5" max="5">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('%') }}
                                </div>
                            </div>
                        </div>
                        @error('uniform')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('SOP') }}<code>*</code></label>
                        <div class="input-group">
                            <input class="form-control @error('sop') is-invalid @enderror" id="sop" type="number"
                                name="sop" required placeholder="Maksimal 30" max="30">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('%') }}
                                </div>
                            </div>
                        </div>
                        @error('sop')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Tanggung Jawab') }}<code>*</code></label>
                        <div class="input-group">
                            <input class="form-control @error('tj') is-invalid @enderror" id="tj" type="number"
                                name="tj" required placeholder="Maksimal 25" max="25">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('%') }}
                                </div>
                            </div>
                        </div>
                        @error('tj')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Kerja Team') }}<code>*</code></label>
                        <div class="input-group">
                            <input class="form-control @error('kt') is-invalid @enderror" id="kt" type="number"
                                name="kt" required placeholder="Maksimal 10" max="10">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('%') }}
                                </div>
                            </div>
                        </div>
                        @error('kt')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Informasi Utama') }}</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>{{ __('Karyawan') }}<code>*</code></label>
                        <select class="form-control select2 @error('karyawan') is-invalid @enderror" name="karyawan">
                            @foreach ($karyawan as $k)
                            <option value="{{ $k->id }}">
                                {{ $k->nama." - ".$k->relationDetailed->jabatan." ".$k->relationDetailed->divisi }}
                            </option>
                            @endforeach
                        </select>
                        @error('karyawan')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Rank') }}<code>*</code></label>
                        <select class="custom-select @error('rank') is-invalid @enderror" name="rank" required>
                            <option value="1">{{ __('Rank 1') }}</option>
                            <option value="2">{{ __('Rank 2') }}</option>
                            <option value="3">{{ __('Rank 3') }}</option>
                        </select>
                        @error('rank')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Dedikasi') }}</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>{{ __('Amanah') }}<code>*</code></label>
                        <div class="input-group">
                            <input class="form-control @error('amanah') is-invalid @enderror" type="number" id="amanah"
                                name="amanah" required placeholder="Maksimal 40" max="40">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('%') }}
                                </div>
                            </div>
                        </div>
                        @error('amanah')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Produktif') }}<code>*</code></label>
                        <div class="input-group">
                            <input class="form-control @error('produktif') is-invalid @enderror" id="produktif"
                                type="number" name="produktif" required placeholder="Maksimal 35" max="35">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('%') }}
                                </div>
                            </div>
                        </div>
                        @error('produktif')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Team Work') }}<code>*</code></label>
                        <div class="input-group">
                            <input class="form-control @error('tw') is-invalid @enderror" id="tw" type="number"
                                name="tw" required placeholder="Maksimal 25" max="25">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('%') }}
                                </div>
                            </div>
                        </div>
                        @error('tw')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>{{ __('Total') }}</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>{{ __('Dedikasi') }}</label>
                <div class="input-group">
                    <input class="form-control @error('dedikasi') is-invalid @enderror" id="dedikasi" type="number"
                        name="dedikasi" readonly>
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{ __('%') }}
                        </div>
                    </div>
                </div>
                @error('dedikasi')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>{{ __('Loyalitas') }}</label>
                <div class="input-group">
                    <input class="form-control @error('loyalitas') is-invalid @enderror" id="loyalitas" type="number"
                        name="loyalitas" readonly>
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{ __('%') }}
                        </div>
                    </div>
                </div>
                @error('loyalitas')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">{{ __('Submit') }}</button>
        </div>
    </div>
</form>
@endsection
@section('script')
<script src="{{ asset('pages/gaji/createLoyalty.js') }}"></script>
@endsection