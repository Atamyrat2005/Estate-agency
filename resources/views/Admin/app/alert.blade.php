@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show position-absolute top-50 end-0 m-3" style="z-index:1111 !important" role="alert">
        <div>@lang('app.error')</div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show position-absolute top-50 end-0 m-3" style="z-index:1 !important;" role="alert">
        <div>{!! session()->get('error') !!}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(isset($success))
    <div class="alert alert-success alert-dismissible fade show position-absolute top-50 end-0 m-3" style="z-index:1 !important;" role="alert">
        <div>{!! $success !!}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show position-absolute top-50 end-0 m-3" style="z-index:1 !important;" role="alert">
        <div>{!! session()->get('success') !!}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif