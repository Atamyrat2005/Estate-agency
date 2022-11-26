@extends('Front.layouts.app')
@section('title') @lang('app.app-description') @endsection
@section('content')
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">@lang('app.contact_us')</h1>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">@lang('app.home')</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                @lang('app.contact_us')
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="contact-map box">
                        <div id="map" class="contact-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3148.109149262098!2d58.37484961492722!3d37.90451137973605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f6ffd86888cde49%3A0x3ac2fcef66cb827f!2z0J7Qu9C40LzQv9C40LnRgdC60LjQuSDRgdGC0LDQtNC40L7QvSDQkNGI0YXQsNCx0LDQtNCw!5e0!3m2!1sru!2s!4v1652898287917!5m2!1sru!2s" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 section-t8">
                    <div class="row">
                        <div class="col-md-7">
                            <form action="{{ route('message.store') }}" method="post" class="php-email-form">
                                @csrf
                                @honeypot
                                @honeypot
                                @honeypot
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <input type="text" placeholder="@lang('app.name')" class="form-control @error('name') is-invalid @enderror" name="name" id="name" autocomplete="off" aria-describedby="nameHelp" autofocus required>
                                            @error('name')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <div class="d-flex justify-content-center align-items-center bg-color-b">+993<input type="number" placeholder="@lang('app.number')" class="form-control @error('number') is-invalid @enderror" name="phone" id="phone" autocomplete="off" min="61000000" max="65999999" aria-describedby="numberHelp" required></div>
                                            @error('phone')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control @error('text') is-invalid @enderror" rows="8" placeholder="@lang('app.message')..." name="text" id="text" autocomplete="off" maxlength="500" aria-describedby="textHelp" required></textarea>
                                            @error('text')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-4 text-center">
                                        <button type="submit" class="btn btn-a">@lang('app.send')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-5 section-md-t3">
                            <div class="icon-box section-b2">
                                <div class="icon-box-icon">
                                    <span class="bi bi-envelope"></span>
                                </div>
                                <div class="icon-box-content table-cell">
                                    <div class="icon-box-title">
                                        <h4 class="icon-title">@lang('app.contact_us')</h4>
                                    </div>
                                    <div class="icon-box-content">
                                        <p class="mb-1">
                                            <span class="color-text-a">@lang('app.email') :</span> <a href="mailto:contact@example.com"> contact@example.com</a>
                                        </p>
                                        <p class="mb-1">
                                            <span class="color-text-a">@lang('app.number') :</span> <a href="tel:+99361000000"> +993 61 000000</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="icon-box section-b2">
                                <div class="icon-box-icon">
                                    <span class="bi bi-geo-alt"></span>
                                </div>
                                <div class="icon-box-content table-cell">
                                    <div class="icon-box-title">
                                        <h4 class="icon-title">@lang('app.find_us')</h4>
                                    </div>
                                    <div class="icon-box-content">
                                        <p class="mb-1">
                                            W93G+RR3, Beýik Saparmyrat Türkmenbaşy şaýoly, Aşgabat
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="icon-box">
                                <div class="icon-box-icon">
                                    <span class="bi bi-share"></span>
                                </div>
                                <div class="icon-box-content table-cell">
                                    <div class="icon-box-title">
                                        <h4 class="icon-title">@lang('app.social')</h4>
                                    </div>
                                    <div class="icon-box-content">
                                        <div class="socials-footer">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="#" class="link-one">
                                                        <i class="bi bi-facebook" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" class="link-one">
                                                        <i class="bi bi-twitter" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" class="link-one">
                                                        <i class="bi bi-instagram" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" class="link-one">
                                                        <i class="bi bi-linkedin" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection