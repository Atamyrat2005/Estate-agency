<div>
    <a href="{{ route('estate', $estate->slug) }}" class="position-relative d-flex justify-content-center align-items-center">
        <img src="{{ $estate->image() }}" alt="" class="img-fluid border jpg rounded">
        @if($estate->isNew())
            <div class="position-absolute text-light small fw-bold bg-danger bg-opacity-75 rounded end-0 top-0 px-1 m-1">
                @lang('app.new')
            </div>
        @endif
            <div class="position-absolute text-light small fw-bold bg-secondary bg-opacity-50 rounded start-0 top-0 px-1 m-1">
                {{ $estate->created_at->format('d.m.Y') }}
            </div>
    </a>
    <div>
        <a href="{{ route('estate', $estate->slug) }}" class="d-block color-b my-1">
            {{ number_format($estate->price, 2, ".", " ") }}<small>TMT</small>
        </a>
    </div>
    <div>
        <a href="{{ route('estate', $estate->slug) }}" class=" h5 d-block link-dark my-1">
            {{ $estate->name }}
        </a>
    </div>
    <div>
        @if($estate->description)
            <div class="mb-3 text-secondary">
                {{ $estate->description }}
            </div>
        @endif
    </div>
</div>
{{--{{ $estate->name }}--}}