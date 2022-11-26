@extends('Admin.layouts.app')
@section('title') @lang('app.visitors') @endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@lang('app.visitors')</h1>
        <div>
            <a class="btn btn-danger btn-sm" href="{{ route('admin.visitors.index') }}"
               onclick="event.preventDefault(); document.getElementById('visitorForm').submit();">
                Gozleg
            </a>
            <a href="{{ url()->current() }}" class="btn btn-secondary btn-sm"><i class="bi bi-trash-fill"></i></a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered table-sm table-striped">
            <thead>
            <tr class="fw-bold">
                <td>ID</td>
                <td>IP address</td>
                <td>Device</td>
                <td>Platform</td>
                <td>Browser</td>
                <td>Robot</td>
                <td>Is desktop</td>
                <td>Is phone</td>
                <td>Is robot</td>
                <td>Requests</td>
                <td>Created at</td>
                <td>Updated at</td>
            </tr>
            <tr>
                <form action="{{ route('admin.visitors.index') }}" id="visitorForm">
                    <td>
                        <input type="text" class="form-control form-control-sm @error('id') is-invalid @enderror" name="id" id="id" value="{{ $f_id }}" maxlength="10">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm @error('ip_address') is-invalid @enderror" name="ip_address" id="ip_address" value="{{ $f_ipAddress }}" maxlength="10">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm @error('device') is-invalid @enderror" name="device" id="device" value="{{ $f_device }}" maxlength="10">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm @error('platform') is-invalid @enderror" name="platform" id="platform" value="{{ $f_platform }}" maxlength="10">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm @error('browser') is-invalid @enderror" name="browser" id="browser" value="{{ $f_browser }}" maxlength="10">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm @error('robot') is-invalid @enderror" name="robot" id="robot" value="{{ $f_robot }}" maxlength="10">
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_desktop" id="is_desktop" value="1" {{ $f_isDesktop ? 'checked':'' }}>
                            <label class="form-check-label" for="is_desktop">
                                Desktop
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_phone" id="is_phone" value="1" {{ $f_isPhone ? 'checked':'' }}>
                            <label class="form-check-label" for="is_phone">
                                Phone
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_robot" id="is_robot" value="1" {{ $f_isRobot ? 'checked':'' }}>
                            <label class="form-check-label" for="is_robot">
                                Robot
                            </label>
                        </div>
                    </td>
                    <td></td>
                    <td>
                        <input type="text" class="form-control form-control-sm @error('created_at') is-invalid @enderror" name="created_at" id="created_at" value="{{ $f_createdAt }}">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm @error('updated_at') is-invalid @enderror" name="updated_at" id="updated_at" value="{{ $f_updatedAt }}">
                    </td>
                </form>
            </tr>
            </thead>
            <tbody>
            @forelse($visitors as $visitor)
                <tr>
                    <td>{{ $visitor->id }}</td>
                    <td>{{ $visitor->ip_address }}</td>
                    <td>{{ $visitor->userAgent->device }}</td>
                    <td>{{ $visitor->userAgent->platform }}</td>
                    <td>{{ $visitor->userAgent->browser }}</td>
                    <td>{{ $visitor->userAgent->robot }}</td>
                    <td>{{ $visitor->userAgent->is_desktop ? 'Yes':'No' }}</td>
                    <td>{{ $visitor->userAgent->is_phone ? 'Yes':'No' }}</td>
                    <td>{{ $visitor->userAgent->is_robot ? 'Yes':'No' }}</td>
                    <td>{{ $visitor->requests }}</td>
                    <td>{{ $visitor->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $visitor->updated_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="12">Not found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $visitors->links() }}
@endsection