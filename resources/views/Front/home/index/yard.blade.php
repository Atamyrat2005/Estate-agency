<div class="container-xxl py-3">
    <div class="d-flex justify-content-between align-items-center border-bottom py-2 mb-3">
        <a href="{{ route('estates', ['y' => 1]) }}" class="d-block h3 mb-0 link-danger">@lang('app.yards')</a>
        <a href="{{ route('estates', ['y' => 1]) }}" class="d-block"><i class="bi bi-chevron-right"></i></a>
    </div>
    <div class="row row-cols-2 row-cols-lg-4 row-cols-xl-4 g-3">
        @foreach($yard as $estate)
            <div class="col" data-aos="fade-up">
                @include('Front.app.estate')
            </div>
        @endforeach
    </div>
</div>
<script>
    AOS.init();
</script>