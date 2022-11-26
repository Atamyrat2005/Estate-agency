@extends('Admin.layouts.app')
@section('title') @lang('app.locations') @endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@lang('app.locations')</h1>
        <div>
            <a class="btn btn-outline-success btn-sm text-decoration-none" href="{{ route('admin.locations.create') }}">@lang('app.location-add')</a>
            <a class="btn btn-danger btn-sm" href="{{ route('admin.locations.index') }}"
               onclick="event.preventDefault(); document.getElementById('locationForm').submit();">
                @lang('app.search')
            </a>
            <a href="{{ url()->current() }}" class="btn btn-secondary btn-sm"><i class="bi bi-trash-fill"></i></a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered table-sm table-striped">
            <thead>
            <tr class="fw-bold">
                <td>ID</td>
                <td>Name_tm</td>
                <td>Name_en</td>
                <td>Name_ru</td>
                <td>Slug</td>
                <td>Sort_order</td>
                <td class="py-4" rowspan="2">Edit</td>
                <td class="py-4" rowspan="2">Delete</td>
            </tr>
            <form action="{{ route('admin.locations.index') }}" id="locationForm">
                <td>
                    <input type="text" class="form-control form-control-sm @error('id') is-invalid @enderror" name="id" id="id" value="{{ $f_id }}" maxlength="5">
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" id="name" value="{{ $f_name }}" maxlength="32">
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm @error('name_en') is-invalid @enderror" name="name_en" id="name_en" value="{{ $f_name_en }}" maxlength="32">
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm @error('name_ru') is-invalid @enderror" name="name_ru" id="name_ru" value="{{ $f_name_ru }}" maxlength="32">
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ $f_slug }}" maxlength="32">
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm @error('sort_order') is-invalid @enderror" name="sort_order" id="sort_order" value="{{ $f_sort_order }}" maxlength="5">
                </td>
            </form>
            </tr>
            </thead>
            <tbody>
            @forelse($locations as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->name }}</td>
                    <td>{{ $location->name_en }}</td>
                    <td>{{ $location->name_ru }}</td>
                    <td>{{ $location->slug }}</td>
                    <td>{{ $location->sort_order }}</td>
                    <td>
                        <div>
                            <a href="{{ route('admin.locations.edit', $location->slug) }}" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                        </div>
                    </td>
                    <td>
                        <form action="{{ route('admin.locations.delete', $location->slug) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-secondary py-1 px-2"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12">Tapylmady</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $locations->links() }}
@endsection