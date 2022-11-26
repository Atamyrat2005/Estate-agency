@extends('Admin.auth.app')
@section('title') @lang('app.login') @endsection
@section('content')
    <form action="{{ route('login') }}" method="post">
        @csrf
        @honeypot
        @honeypot
        @honeypot
        <div class="mb-3">
            <label for="username" class="form-label">@lang('app.username')</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" autocomplete="off" aria-describedby="usernameHelp" autofocus>
            @error('username')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">@lang('app.password')</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
            @error('password')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-box-arrow-in-right me-1"></i> @lang('app.login')
        </button>
    </form>
@endsection