@extends('Front.layouts.app')
@section('title') @lang('app.app-description') @endsection
@section('content')
    <div class="container-xxl py-3 mt-100">
        <div class="d-flex justify-content-between align-items-center border-bottom py-2 mb-3">
                            <a href="{{ route('estates') }}" class="d-block h3 mb-0 color-b">@lang('app.estates')</a>
            <form action="{{ route('estates') }}">
                <div class="d-flex justify-content-center align-items-center"><input class="form-control form-control-sm" type="text" placeholder="@lang('app.search')" aria-label="Search" name="q"><button class="btn bg-color-b btn-sm" type="submit"><i class="bi bi-search"></i></button></div>
            </form>
        </div>
        <div class="row g-3">
            <div class="col-sm-4 col-md-3 col-lg-2">
                @include('Front.app.filter')
            </div>
            <div class="col-sm">
                @if($estates->count() > 0)
                    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
                        @foreach($estates as $estate)
                            <div class="col">
                                @include('Front.app.estate')
                            </div>
                        @endforeach
                    </div>
                    <div class="my-3">
                        {{ $estates->links() }}
                    </div>
                @else
                    <div class="p-5 h2 mb-0 text-center">
                        @lang('app.not-found', ['name' => request('q')])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection