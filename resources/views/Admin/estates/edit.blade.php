@extends('Admin.layouts.app')
@section('title') {{ $estate->name }} - @lang('app.edit') @endsection
@section('content')
    <div class="container-xxl py-3">
        <div class="d-block h4 text-danger text-center border-bottom py-2 mb-3">
            {{ $estate->name }} - @lang('app.edit')
        </div>
        <div class="row justify-content-center">
            <form action="{{ route('admin.estates.update', $estate->slug) }}" method="post" enctype="multipart/form-data" class="col-md-6 col-lg-4">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="category_id" class="form-label fw-bold">
                        @lang('app.category') <span class="text-danger">*</span>
                    </label>
                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required autofocus>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $estate->category_id ? 'selected':'' }}>
                                {{ $category->name() }}
                            </option>
            p            @endforeach
                    </select>
                    @error('category_id')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="brand_id" class="form-label fw-bold">
                        @lang('app.location') <span class="text-danger">*</span>
                    </label>
                    <select class="form-select @error('brand_id') is-invalid @enderror" id="location_id" name="location_id" required>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" {{ $location->id == $estate->location_id ? 'selected':'' }}>
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('location_id')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">
                        @lang('app.name') <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $estate->name }}" required>
                    @error('name')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label fw-bold">
                        @lang('app.price') <span class="text-danger">*</span>
                    </label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{ $estate->price }}" min="0" step="0.1" required>
                    @error('price')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label fw-bold">
                        @lang('app.number') <span class="text-danger">*</span>
                    </label>
                    <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ $estate->phone }}" min="61000000" max="65999999" required>
                    @error('phone')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label fw-bold">
                        @lang('app.slug') <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ $estate->slug }}" maxlength="30" required>
                    @error('price')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">
                        @lang('app.description')
                    </label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3" maxlength="2550">{{ $estate->description }}</textarea>
                    @error('description')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                @foreach($options as $option)
                    <div class="mb-3">
                        <label for="option_{{ $option->id }}" class="form-label fw-bold">
                            {{ $option->name }} <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('values_id') is-invalid @enderror" id="option_{{ $option->id }}" name="values_id[]" required>
                            @foreach($option->values as $value)
                                <option value="{{ $value->id }}" {{ $estate->values->contains($value->id) ? 'selected':'' }}>
                                    {{ $value->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('values_id')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                @endforeach

                <div class="mb-3">
                    <label for="image" class="form-label fw-bold">@lang('app.image')</label>
                    <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" accept="image/jpeg">
                    @error('image')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="t" id="credit" value="1" {{ $estate->credit ? 'checked':'' }}>
                        <label class="form-check-label" for="credit">
                            @lang('app.credit')
                        </label>
                        @error('credit')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="s" id="swap" value="1" {{ $estate->swap ? 'checked':'' }}>
                        <label class="form-check-label" for="swap">
                            @lang('app.swap')
                        </label>
                        @error('swap')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="y" id="yard" value="1" {{ $estate->yard ? 'checked':'' }}>
                        <label class="form-check-label" for="yard">
                            @lang('app.yard')
                        </label>
                        @error('yard')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="a" id="balcony" value="1" {{ $estate->balcony ? 'checked':'' }}>
                        <label class="form-check-label" for="balcony">
                            @lang('app.balcony')
                        </label>
                        @error('balcony')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="i" id="lift" value="1" {{ $estate->lift ? 'checked':'' }}>
                        <label class="form-check-label" for="lift">
                            @lang('app.lift')
                        </label>
                        @error('lift')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2-circle"></i> @lang('app.update')
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection