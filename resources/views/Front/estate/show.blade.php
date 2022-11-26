@extends('Front.layouts.app')
@section('title') {{ $estate->name() }} @endsection
@section('content')
    <div class="container-xxl py-3 mt-100">
        <div class="d-flex justify-content-between align-items-center border-bottom py-2 mb-3">
            <div class="h4 text-danger">{{ $estate->name}}</div>
        </div>
        <div class="row g-3">
            <div class="col-sm-6 col-lg-4">
                <div class="position-relative d-flex justify-content-center align-items-center">
                    <img src="{{ $estate->image() }}" alt="" class="img-fluid border rounded">
                    @if($estate->isNew())
                        <div class="position-absolute text-light fw-bold bg-danger bg-opacity-75 rounded end-0 top-0 px-1 m-1">
                            @lang('app.new')
                        </div>
                    @endif
                    <div class="position-absolute text-light small fw-bold bg-secondary bg-opacity-50 rounded start-0 top-0 px-1 m-1">
                        {{ $estate->created_at->format('d.m.Y') }}
                    </div>
                    <div class="position-absolute text-light fw-bold bg-secondary bg-opacity-50 rounded end-0 bottom-0 px-1 m-1">
                        <span class="color-b">{{ number_format($estate->price, 2, ".", " ") }} <small>TMT</small></span>
                    </div>
                </div>
            </div>
            <div class="col">
                <a href="{{ route('estates', ['l' => [$estate->location_id]]) }}" class="d-block h5 fw-bold text-dark mb-2">
                @lang('app.location') : <span class="link-secondary"> {{ $estate->location->name() }} </span>
                </a>
                <a href="{{ route('estates', ['c' => [$estate->category_id]]) }}" class="d-block h5 fw-bold text-dark mb-2">
                    @lang('app.category') : <span class="link-secondary"> {{ $estate->category->name() }} </span>
                </a>
                <div class="d-flex">
                    <div class="h5 fw-bold" style="width: 10rem">
                        @if($estate->yard)
                            <a href="{{ route('estates', ['y=1'])}}" class="d-block h6 link-secondary mb-2">
                                @lang('app.yard') : @lang('app.yes')
                            </a>
                        @else
                            <a href="{{ route('estates', ['y=1'])}}" class="d-block h6 link-secondary mb-2">
                                @lang('app.yard') : @lang('app.no')
                            </a>
                        @endif

                        @if($estate->lift)
                            <a href="{{ route('estates', ['i=1'])}}" class="d-block h6 link-secondary mb-2">
                                @lang('app.lift') : @lang('app.yes')
                            </a>
                        @else
                            <a href="{{ route('estates', ['i=1'])}}" class="d-block h6 link-secondary mb-2">
                                @lang('app.lift') : @lang('app.no')
                            </a>
                        @endif

                        @if($estate->swap)
                            <a href="{{ route('estates', ['a=1'])}}" class="d-block h6 link-secondary mb-2">
                                @lang('app.balcony') : @lang('app.yes')
                            </a>
                        @else
                            <a href="{{ route('estates', ['a=1'])}}" class="d-block h6 link-secondary mb-2">
                                @lang('app.balcony') : @lang('app.no')
                            </a>
                        @endif
                    </div>
                    <div class="h5 fw-bold">
                        @if($estate->credit)
                            <a href="{{ route('estates', ['t=1'])}}" class="d-block h6 link-secondary mb-2">
                                @lang('app.credit') : @lang('app.yes')
                            </a>
                        @else
                            <a href="{{ route('estates', ['t=1'])}}" class="d-block h6 link-secondary mb-2">
                                @lang('app.credit') : @lang('app.no')
                            </a>
                        @endif

                        @if($estate->swap)
                            <a href="{{ route('estates', ['s=1'])}}" class="d-block h6 link-secondary mb-2">
                                @lang('app.swap') : @lang('app.yes')
                            </a>
                        @else
                            <a href="{{ route('estates', ['s=1'])}}" class="d-block h6 link-secondary mb-2">
                                @lang('app.swap') : @lang('app.no')
                            </a>
                        @endif
                    </div>
                </div>
                @foreach($estate->values as $value)
                    <div class="{{ $loop->last ? 'mb-3':'mb-2' }}">
                        <span class="text-dark">{{ $value->option->name() }}:</span>
                        <a href="{{ route('estates', ['v' => [[$value->id]]]) }}" class="link-secondary">{{ $value->name() }}</a>
                    </div>
                @endforeach
                <div class="d-flex align-items-center fw-bold mb-3">
                    <div class="me-4">
                        <i class="bi bi-binoculars-fill text-black-50"></i> {{ $estate->viewed }}
                    </div>
                    <a href="{{ route('estate.favorite', $estate->slug) }}" class="btn btn-danger btn-sm text-decoration-none">
                        <i class="bi bi-heart-fill"></i> {{ $estate->favorited }}
                    </a>
                    <a href="tel:+993{{ $estate->phone }}"><i class="bi bi-phone-vibrate-fill"></i></a>
                </div>
                @if($estate->description)
                    <div class="mb-3">
                        {!! $estate->description !!}
                    </div>
                @endif
            </div>
        </div>
        <div class="my-3">
            <div class="d-flex justify-content-between align-items-center border-bottom py-2 mb-3">
                <a class="d-block h4 mb-0 link-danger">@lang('app.similar')</a>
                <a class="d-block"><i class="bi bi-chevron-right"></i></a>
            </div>
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 g-3">
                @foreach($similar as $estate)
                    <div class="col">
                        @include('Front.app.estate')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection