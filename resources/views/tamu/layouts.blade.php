<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', $configuration->title ?? '')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $configuration->meta_descriptions ?? '' }}" />
    <meta name="keywords" content="{{ $configuration->meta_keywords ?? '' }}" />
    <link rel="shortcut icon" href="{{ asset($configuration->title_logo ?? '') }}" type="image/x-icon">
    <meta name="author" content="Akmal" />
    <link rel="stylesheet" type="text/css"
        href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">

    <link rel="stylesheet" href="{{ asset('tamu/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('tamu/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('tamu/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('tamu/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('tamu/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('tamu/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('tamu/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('tamu/css/fancybox.min.css') }}">
    <script src="{{ asset('tamu/js/jquery-3.6.0.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('tamu/fonts/ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('tamu/fonts/fontawesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('tamu/css/jquery.fancybox.min.css') }}">
    <!-- Theme Style -->
    <link rel="stylesheet" href="{{ asset('tamu/css/style.css') }}">

</head>

<body>
    <a href="https://wa.me/{{ $configuration->phone_number ?? '' }}" target="_blank" class="whatsapp-btn">
        <i class="fa fa-whatsapp"></i>
    </a>
    <header class="site-header js-site-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-6 col-lg-4 site-logo" data-aos="fade"><a
                        href="index.html">{{ $configuration->company_name ?? '' }}</a></div>
                <div class="col-6 col-lg-8">

                    <div class="site-menu-toggle js-site-menu-toggle" data-aos="fade">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <!-- END menu-toggle -->

                    <div class="site-navbar js-site-navbar">
                        <nav role="navigation">
                            <div class="container">
                                <div class="row full-height align-items-center">
                                    <div class="col-md-6 mx-auto">
                                        <ul class="list-unstyled menu">
                                            <li class="{{ Route::currentRouteName() == 'index' ? 'active' : '' }}"><a
                                                    href="{{ route('index') }}">Beranda</a></li>
                                            <li class="{{ Route::currentRouteName() == 'room' ? 'active' : '' }}"><a
                                                    href="{{ route('room') }}">Kamar</a></li>
                                            <li class="{{ Route::currentRouteName() == 'about' ? 'active' : '' }}"><a
                                                    href="{{ route('about') }}">Tentang</a></li>
                                            <li class="{{ Route::currentRouteName() == 'gallery' ? 'active' : '' }}"><a
                                                    href="{{ route('gallery') }}">Galeri</a></li>
                                            <li class="{{ Route::currentRouteName() == 'blog' ? 'active' : '' }}"><a
                                                    href="{{ route('blog') }}">Blog</a></li>
                                            <li class="{{ Route::currentRouteName() == 'contact' ? 'active' : '' }}"><a
                                                    href="{{ route('contact') }}">Kontak</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- END head -->

    @if (Request::path() !== '/')
        <section class="site-hero inner-page overlay"
            style="background-image: url({{ asset('tamu/images/hero_4.jpg') }})" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row site-hero-inner justify-content-center align-items-center">
                    <div class="col-md-10 text-center" data-aos="fade">
                        <h1 class="heading mb-3">@yield('site-hero')</h1>
                        <ul class="custom-breadcrumbs mb-4">
                            <li><a href="{{ route('index') }}">Beranda</a></li>
                            <li>&bullet;</li>
                            <li>@yield('site-hero')</li>
                        </ul>
                    </div>
                </div>
            </div>

            <a class="mouse smoothscroll" href="#next">
                <div class="mouse-icon">
                    <span class="mouse-wheel"></span>
                </div>
            </a>
        </section>
    @endif
    <!-- END section -->

    @yield('content')

    @vite(['resources/js/app.js'])

    <script>
        @if (session('success'))
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                showConfirmButton: true,
            });
        @endif
    </script>

    <section class="section bg-image overlay" style="background-image: url('tamu/images/hero_4.jpg');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 text-center mb-4 mb-md-0 text-md-left" data-aos="fade-up">
                    <h3 class="text-white font-weight-bold">Tempat Terbaik untuk Menginap. Pesan Sekarang!</h3>
                </div>
                <div class="col-12 col-md-6 text-center text-md-right" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('reservation') }}"
                        class="btn btn-outline-white-primary py-3 text-white px-5">Pesan Sekarang!</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="section footer-section">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-3 mb-5 text-center">
                    <div style="background-color: white; display: inline-block; padding: 10px; border-radius: 8px;">
                        <img src="{{ asset($configuration->logo) }}" alt="Logo" class="img-fluid"
                            style="max-width: 150px;">
                    </div>
                    <h4 class="mt-3 text-white">{{ $configuration->company_name ?? '' }}</h4>
                </div>

                <div class="col-md-3 mb-5">
                    <ul class="list-unstyled link">
                        <li><a href="{{ route('room') }}">Kamar</a></li>
                        <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><a href="{{ route('gallery') }}">Galeri</a></li>
                        <li><a href="{{ route('contact') }}">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-5 pr-md-5 contact-info">
                    <!-- <li>198 West 21th Street, <br> Suite 721 New York NY 10016</li> -->
                    <p><span class="d-block"><span class="ion-ios-location h5 mr-3 text-primary"></span>Alamat:</span>
                        <span> {{ $configuration->address ?? '' }}</span>
                    </p>
                    <p><span class="d-block"><span
                                class="ion-ios-telephone h5 mr-3 text-primary"></span>Telepon:</span>
                        <span>{{ $configuration->phone_number ?? '' }}</span>
                    </p>
                    <p><span class="d-block"><span class="ion-ios-email h5 mr-3 text-primary"></span>Email:</span>
                        <span> {{ $configuration->email_address ?? '' }}</span>
                    </p>
                </div>
                <div class="col-md-3 mb-5">
                    <iframe src="{{ $configuration->map ?? '' }}" width="100%" height="300" style="border:0;"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

            </div>
            <div class="row pt-5">
                <p class="col-md-6 text-left">
                    {{ $configuration->footer ?? '' }}
                </p>

                <p class="col-md-6 text-right social">
                    @if ($configuration->phone_number)
                        <a href="https://wa.me/{{ $configuration->phone_number }}" target="_blank">
                            <span class="fa fa-whatsapp"></span>
                        </a>
                    @endif

                    @if ($configuration->email_address)
                        <a href="mailto:{{ $configuration->email_address }}">
                            <span class="fa fa-envelope"></span>
                        </a>
                    @endif

                    @if ($configuration->instagram)
                        <a href="{{ $configuration->instagram }}" target="_blank">
                            <span class="fa fa-instagram"></span>
                        </a>
                    @endif

                    @if ($configuration->youtube)
                        <a href="{{ $configuration->youtube }}" target="_blank">
                            <span class="fa fa-youtube"></span>
                        </a>
                    @endif
                </p>
            </div>
        </div>
    </footer>
    <script src="{{ asset('tamu/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('tamu/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('tamu/js/popper.min.js') }}"></script>
    <script src="{{ asset('tamu/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('tamu/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('tamu/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('tamu/js/jquery.fancybox.min.js') }}"></script>

    <script src="{{ asset('tamu/js/aos.js') }}"></script>

    <script src="{{ asset('tamu/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('tamu/js/jquery.timepicker.min.js') }}"></script>

    <script src="{{ asset('tamu/js/main.js') }}"></script>
    <script src="{{ asset('tamu/js/lightbox.js') }}"></script>

</body>

</html>
