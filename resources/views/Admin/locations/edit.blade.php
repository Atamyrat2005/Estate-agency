@extends('Admin.layouts.app')
@section('title') {{ $location->name }} - @lang('app.edit') @endsection
@section('content')
    <div class="container-xxl py-3">
        <div class="d-block h4 text-danger text-center border-bottom py-2 mb-3">
            {{ $location->name }} - @lang('app.edit')
        </div>
        <div class="row justify-content-center">
            <form action="{{ route('admin.locations.update', $location->slug) }}" method="post" enctype="multipart/form-data" class="col-md-6 col-lg-4">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">
                        Name_tm <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $location->name }}" maxlength="32" required>
                    @error('name')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name_en" class="form-label fw-bold">
                        Name_en <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" id="name_en" value="{{ $location->name_en }}" maxlength="32" required>
                    @error('name_en')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name_ru" class="form-label fw-bold">
                        Name_ru <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('name_ru') is-invalid @enderror" name="name_ru" id="name_ru" value="{{ $location->name_ru }}" maxlength="32" required>
                    @error('name_ru')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label fw-bold">
                        Slug <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ $location->slug }}" maxlength="32" required>
                    @error('slug')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sort_order" class="form-label fw-bold">
                        Sort_order <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('sort_order') is-invalid @enderror" name="sort_order" id="sort_order" value="{{ $location->sort_order }}" maxlength="5" required>
                    @error('sort_order')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2-circle"></i> @lang('app.store')
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection