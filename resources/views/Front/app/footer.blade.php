<section class="section-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="widget-a">
                    <div class="w-header-a">
                        <h3 class="w-title-a text-brand">@lang('app.app-name')</h3>
                    </div>
                    <div class="w-body-a">
                        <p class="w-text-a color-text-a">
                            @lang('app.app-description')
                        </p>
                    </div>
                    <div class="w-footer-a">
                        <ul class="list-unstyled">
                            <li class="color-a">
                                <span class="color-text-a">@lang('app.email') :</span> <a href="mailto:contact@example.com"> contact@example.com</a>
                            </li>
                            <li class="color-a">
                                <span class="color-text-a">@lang('app.number') :</span> <a href="tel:+99361000000"> +993 61 000000</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 section-md-t3">
                <div class="widget-a">
                    <div class="w-header-a">
                        <h3 class="w-title-a text-brand">@lang('app.categories')</h3>
                    </div>
                    <div class="w-body-a">
                        <div class="w-body-a">
                            <ul class="list-unstyled">
                                @foreach($categories as $category)
                                    <li class="item-list-a">
                                        <i class="bi bi-chevron-right"></i> <a href="{{ route('estates', ['c' => [$category->id]]) }}">{{ $category->name() }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 section-md-t3">
                <div class="widget-a">
                    <div class="w-header-a">
                        <h3 class="w-title-a text-brand">@lang('app.locations')</h3>
                    </div>
                    <div class="w-body-a">
                        <ul class="list-unstyled">
                            @foreach($locations as $location)
                            <li class="item-list-a">
                                <i class="bi bi-chevron-right"></i> <a href="{{ route('estates', ['l' => [$location->id]]) }}">{{ $location->name() }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="nav-footer">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="{{ route('home') }}">@lang('app.home')</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('estates')}}">@lang('app.estates')</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('message')}}">@lang('app.contact_us')</a>
                        </li>
                    </ul>
                </nav>
                <div class="socials-a">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="bi bi-facebook" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="bi bi-twitter" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="bi bi-instagram" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="bi bi-linkedin" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="copyright-footer">
                    <p class="copyright color-text-a">
                        &copy; 2022
                        <span class="color-a">@lang('app.app-name')</span> @lang('app.footer')
                    </p>
                </div>
                <div class="credits">
                    Made by <a href="{{ route('atamyrat') }}">Atamyrat</a>
                </div>
            </div>
        </div>
    </div>
</footer>