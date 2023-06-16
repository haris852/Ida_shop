<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        {{ env('APP_NAME') }}
    </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Manrope-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Alert -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        * {
            font-family: 'Manrope', sans-serif;
        }

        button {
            font-family: 'Manrope', sans-serif;
        }

        .btn-primary {
            background-color: #1F3BB3;
            border-color: #1F3BB3;
        }

        .text-primary {
            color: #1F3BB3 !important;
        }

        .nav-item a,
        .btn {
            font-size: 0.9rem;
        }

        html,
        body {
            height: 100%;
        }

        .footer {
            font-size: 0.9rem;
            /* always in bottom not fixed */
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .card-img {
            object-fit: cover;
        }

        .card-img-top {
            height: 200px;
        }

        .card {
            font-size: 0.9rem;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="
    overflow-x-hidden overflow-y-auto h-full
">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent mt-3">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse container" id="navbarTogglerDemo01">
            <a class="navbar-brand d-none-md" href="/">
                <img src="{{ asset('customer_asset/img/logo.svg') }}" width="40" height="40" alt=""
                    style="filter: invert(1) sepia(1) saturate(1) hue-rotate(180deg);">
            </a>
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Beranda <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user-customer.order.index') ? 'active' : '' }}"
                        href="{{ route('user-customer.order.index') }}">Pesanan</a>
                </li>
                @auth
                    @if (session()->has('cart') && count(session()->get('cart')) > 0)
                        <li class="nav-item {{ request()->routeIs('cart') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('cart') }}">Keranjang
                                @if (session()->has('cart') && count(session()->get('cart')) > 0)
                                    <span
                                        class="ml-1 badge badge-pill badge-danger">{{ count(session()->get('cart')) }}</span>
                                @endif
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
            @if (auth()->check())
                {{-- dropdown image and name --}}
                <div class="dropdown">
                    <a class="dropdown-toggle text-dark" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ auth()->user()->avatar ? asset('storage/avatar/' . auth()->user()->avatar) : asset('assets/image/defaultuser.jpg') }}"
                            width="40" height="40" alt="" class="rounded-circle mr-2"
                            style="filter: invert(1) sepia(1) saturate(1) hue-rotate(180deg);">
                        {{ auth()->user()->name }}
                    </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a href="{{ route('user.message.index') }}" class="dropdown-item">Pesan</a>
                            <a href="{{ route('user.setting.index') }}" class="dropdown-item">Pengaturan</a>
                            <a href="{{ route('logout') }}" class="dropdown-item">Keluar</a>
                        </div>
                    </div>
                @else
                    <form class="form-inline my-2 my-lg-0">
                        <a href="{{ route('login') }}" class="btn btn-primary my-2 my-sm-0">Masuk</a>
                    </form>
                @endif
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        @yield('content')
    </div>

    <footer class="footer">
        <p class="text-center">© 2023 {{ config('app.name', 'Laravel') }}. All rights reserved.</p>

    </footer>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    <!-- Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <!-- Pusher -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    @stack('js-internal')
</body>

</html>
