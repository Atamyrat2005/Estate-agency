<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <a class="navbar-brand text-brand" href="{{ route('home') }}">Estate<span class="color-b"> Agency</span></a>

        <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-bs-toggle="dropdown" aria-expanded="false">@lang('app.categories')</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown02">
                        @foreach($categories as $category)
                            <li>
                                <a class="dropdown-item" href="{{ route('estates', ['c' => [$category->id]]) }}">
                                    {{ $category->name() }} <span class="badge bg-light text-dark">{{ $category->estates_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-bs-toggle="dropdown" aria-expanded="false">@lang('app.locations')</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown02">
                        @foreach($locations as $location)
                            <li>
                                <a class="dropdown-item" href="{{ route('estates', ['l' => [$location->id]]) }}">
                                    {{ $location->name() }} <span class="badge bg-light text-dark">{{ $location->estates_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('estates')}}">@lang('app.estates')</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('message') }}">@lang('app.contact_us')</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-bs-toggle="dropdown" aria-expanded="false">@lang('app.lang')</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown02">
                        <li>
                            <a class="dropdown-item" href="{{ route('language', 'tm') }}">Türkmen</a>
                            <a class="dropdown-item" href="{{ route('language', 'ru') }}">Русский</a>
                            <a class="dropdown-item" href="{{ route('language', 'en') }}">English</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
