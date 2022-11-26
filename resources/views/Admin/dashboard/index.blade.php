@extends('Admin.layouts.app')
@section('title') @lang('app.dashboard') @endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@lang('app.dashboard')</h1>
        <li class="nav-item d-flex justify-content-end dropdown">
            <a class="nav-link dropdown-toggle color-b" href="#" id="dropdown02" data-bs-toggle="dropdown" aria-expanded="false">@lang('app.lang')</a>
            <ul class="dropdown-menu fw-bold border-3 border-dark " aria-labelledby="dropdown02">
                <li>
                    <a class="dropdown-item color-y-bg" href="{{ route('language', 'tm') }}">Türkmen</a>
                    <a class="dropdown-item color-y-bg" href="{{ route('language', 'ru') }}">Русский</a>
                    <a class="dropdown-item color-y-bg" href="{{ route('language', 'en') }}">English</a>
                </li>
            </ul>
        </li>
    </div>
@endsection