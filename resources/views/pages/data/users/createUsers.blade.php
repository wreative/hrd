@extends('layouts.default')
@section('title', __('HRD Batubeling | Tambah Pengguna'))
@section('titleContent', __('Tambah Pengguna'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Pengguna') }}</div>
<div class="breadcrumb-item active">{{ __('Tambah Pengguna') }}</div>
@endsection

@section('content')
<div class="card">
    <form method="POST" action="{{ route('user.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <div class="d-block">
                    <label for="name" class="control-label">{{ __('Nama') }}<code>*</code></label>
                </div>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    required autofocus>
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="username">{{ __('Username') }}<code>*</code></label>
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                    name="username" value="{{ old('username') }}" required autocomplete="username">
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">{{ __('Password') }}<code>*</code></label>
                </div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password-confirm" class="control-label">{{ __('Ulangi Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
            </div>
            <div class="form-group">
                <label>{{ __('Roles') }}<code>*</code></label>
                <select class="form-control selectric @error('roles') is-invalid @enderror" name="roles" required>
                    <option value="Administrator">
                        {{ __('Administrator') }}
                    </option>
                    <option value="Manager">
                        {{ __('Manager') }}
                    </option>
                    <option value="User">
                        {{ __('User') }}
                    </option>
                </select>
                @error('roles')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" type="submit">{{ __('Tambah Pengguna') }}</button>
            </div>
        </div>
    </form>
</div>
@endsection