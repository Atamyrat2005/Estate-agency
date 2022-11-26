@extends('Admin.layouts.app')
@section('title') @lang('app.estates') @endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@lang('app.estates')</h1>
        <div>
            <a class="btn btn-outline-success btn-sm text-decoration-none" href="{{ route('admin.estates.create') }}">@lang('app.estate-add')</a>
            <a class="btn btn-danger btn-sm" href="{{ route('admin.estates.index') }}"
               onclick="event.preventDefault(); document.getElementById('estateForm').submit();">
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
                <td class="py-4" rowspan="2">Image</td>
                <td>Locations</td>
                <td>Categories</td>
                <td>Values</td>
                <td>Price</td>
                <td>Name</td>
                <td>Phone</td>
                <td>Slug</td>
                <td>Description</td>
                {{--<td>New</td>--}}
                <td>Credit</td>
                <td>Swap</td>
                <td>Yard</td>
                <td>Lift</td>
                <td>Balcony</td>
                <td class="py-4" rowspan="2">Edit</td>
                <td class="py-4" rowspan="2">Delete</td>
            </tr>
            <tr>
                <form action="{{ route('admin.estates.index') }}" id="estateForm">
                    <td>
                        <input type="text" class="form-control form-control-sm @error('id') is-invalid @enderror" name="id" id="id" value="{{ $e_id }}" maxlength="10">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm @error('locations') is-invalid @enderror" name="l" id="locations" value="{{ $e_locations }}" maxlength="10">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm @error('categories') is-invalid @enderror" name="c" id="categories" value="{{ $e_categories }}" maxlength="10">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm @error('values') is-invalid @enderror" name="v" id="values" value="{{ $e_values }}" maxlength="20">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm @error('price') is-invalid @enderror" name="price" id="price" value="{{ $e_price }}" maxlength="10">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" id="name" value="{{ $e_name }}" maxlength="10">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ $e_phone }}" maxlength="10">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ $e_slug }}" maxlength="10">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm @error('description') is-invalid @enderror" name="description" id="description" value="{{ $e_description }}" maxlength="10">
                    </td>
                    {{--<td>--}}
                        {{--<div class="form-check">--}}
                            {{--<input class="form-check-input" type="checkbox" name="n" id="new" value="1" {{ $e_new ? 'checked':'' }}>--}}
                            {{--<label class="form-check-label" for="new">--}}
                                {{--New--}}
                            {{--</label>--}}
                        {{--</div>--}}
                    {{--</td>--}}
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="t" id="credit" value="1" {{ $e_credit ? 'checked':'' }}>
                            <label class="form-check-label" for="credit">
                                Credit
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="s" id="swap" value="1" {{ $e_swap ? 'checked':'' }}>
                            <label class="form-check-label" for="swap">
                                Swap
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="y" id="yard" value="1" {{ $e_yard ? 'checked':'' }}>
                            <label class="form-check-label" for="yard">
                                Yard
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="i" id="lift" value="1" {{ $e_lift ? 'checked':'' }}>
                            <label class="form-check-label" for="lift">
                                Lift
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="a" id="balcony" value="1" {{ $e_balcony ? 'checked':'' }}>
                            <label class="form-check-label" for="balcony">
                                Balcony
                            </label>
                        </div>
                    </td>
                </form>
            </tr>
            </thead>
            <tbody>
            @forelse($estates as $estate)
                <tr>
                    <td>{{ $estate->id }}</td>
                    <td><img src="{{ $estate->image() }}" alt="" class="img-fluid border rounded"></td>
                    <td>{{ $estate->location->name }}</td>
                    <td>{{ $estate->category->name }}</td>

                    <td>
                        @foreach ($estate->values as $value)
                            <p>{{$value->option->name . ":" . $value->name}}</p>
                        @endforeach
                    </td>
                    <td>{{ number_format($estate->price, 2, ".", " ") }} <small>TMT</small></td>
                    <td>{{ $estate->name }}</td>
                    <td>{{ "+993" . $estate->phone }}</td>
                    <td>{{ $estate->slug }}</td>
                    <td>{{ $estate->description }}</td>
                    {{--<td>{{ $estate->estate->new ? 'Yes':'No' }}</td>--}}
                    <td>{{ $estate->credit ? 'Yes':'No' }}</td>
                    <td>{{ $estate->swap ? 'Yes':'No' }}</td>
                    <td>{{ $estate->yard ? 'Yes':'No' }}</td>
                    <td>{{ $estate->lift ? 'Yes':'No' }}</td>
                    <td>{{ $estate->balcony ? 'Yes':'No' }}</td>
                    <td>
                        <div>
                            <a href="{{ route('admin.estates.edit', $estate->slug) }}" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                        </div>
                    </td>
                    <td>
                        <form action="{{ route('admin.estates.delete', $estate->slug) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-secondary py-1 px-2"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="16">Not found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $estates->links() }}
@endsection