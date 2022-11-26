@extends('Admin.layouts.app')
@section('title') @lang('app.messages') @endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@lang('app.messages')</h1>
        <div>
            <a class="btn btn-danger btn-sm" href="{{ route('admin.messages.index') }}"
               onclick="event.preventDefault(); document.getElementById('messageForm').submit();">
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
                <td>Name</td>
                <td>Phone number</td>
                <td>Text</td>
                <td>Created at</td>
                <td class="py-4" rowspan="2">Delete</td>
            </tr>
            <form action="{{ route('admin.messages.index') }}" id="messageForm">
                <td>
                    <input type="text" class="form-control form-control-sm @error('id') is-invalid @enderror" name="id" id="id" value="{{ $f_id }}" maxlength="5">
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" id="name" value="{{ $f_name }}" maxlength="32">
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ $f_phone }}" min="61000000" max="65000000">
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm @error('text') is-invalid @enderror" name="text" id="text" value="{{ $f_text }}" maxlength="128">
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm @error('created_at') is-invalid @enderror" name="created_at" id="created_at" value="{{ $f_createdAt }}">
                </td>
            </form>
            </tr>
            </thead>
            <tbody>
            @forelse($messages as $message)
                <tr>
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->name }}</td>
                    <td>+993 {{ $message->phone }}</td>
                    <td>{{ $message->text }}</td>
                    <td>{{ $message->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <form action="{{ route('admin.messages.delete', $message->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-secondary py-1 px-2"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Tapylmady</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $messages->links() }}
@endsection