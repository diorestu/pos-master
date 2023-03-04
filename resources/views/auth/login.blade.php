@extends('layouts.guest')

@section('content')
    <form class="card card-md rounded-5 shadow-sm" action="{{ route('login') }}" method="post" autocomplete="off">
        @csrf

        <div class="card-body">
            <h2 class="card-title text-dark text-center mb-4"><strong>{{ __('Login ke akun Anda') }}</strong></h2>

            <div class="mb-3">
                <label class="form-label text-danger">{{ __('Nama Pengguna') }}</label>
                <input type="text" name="username" value="{{ old('username') }}"
                    class="form-control @error('username') is-invalid @enderror" placeholder="{{ __('Nama Pengguna') }}"
                    required autofocus tabindex="1">
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-danger">
                    {{ __('Password') }}
                </label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="{{ __('Kata Sandi') }}" required tabindex="2">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-red btn-pill w-100" tabindex="4">{{ __('Masuk') }}</button>
            </div>
        </div>
    </form>
@endsection
