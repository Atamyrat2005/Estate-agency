
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - @lang('app.app-name')</title>
    <link rel="icon" href="{{ asset('img/log.png') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/Jquery.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/aos.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/splide.min.js') }}"></script>
</head>
@include('Front.app.alert')
<body class="bg-light">
@include('Front.app.navbar')
@yield('content')
@include('Front.app.footer')
<div id="preloader"></div>
<div id="scrollToTop" class="py-1 px-2 rounded-circle"><i class="bi bi-arrow-up-short"></i></div>
<script>
    const scrollToTop = document.querySelector("#scrollToTop");
        window.addEventListener("scroll", scrollFunction);

        function scrollFunction() {
            if(window.pageYOffset > 300){
                scrollToTop.style.display = "flex";
            }
            else {
                scrollToTop.style.display = "none";
            }
        }

    scrollToTop.addEventListener("click", backToTop);

        function backToTop() {
            window.scrollTo(0, 0);
        }
</script>
<script>
    setTimeout(function () {
        $('#preloader').fadeToggle();
    },600);
</script>
</body>
</html>
