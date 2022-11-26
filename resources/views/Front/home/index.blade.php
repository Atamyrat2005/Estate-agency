@extends('Front.layouts.app')
@section('title') @lang('app.app-description') @endsection
@section('content')
    @if($new->count() > 0)
        @include('Front.home.index.new')
    @endif
    @if($credit->count() > 0)
        @include('Front.home.index.credit')
    @endif
    @if($swap->count() > 0)
        @include('Front.home.index.swap')
    @endif
    @if($lift->count() > 0)
        @include('Front.home.index.lift')
    @endif
    @if($yard->count() > 0)
        @include('Front.home.index.yard')
    @endif
    @if($balcony->count() > 0)
        @include('Front.home.index.balcony')
    @endif
@endsection