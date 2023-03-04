<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <title>PIA LEGONG POS</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('build/datatables.min.css') }}" />
    <script>
        function createPopupWin(pageURL, pageTitle,
            popupWinWidth, popupWinHeight) {
            var left = (screen.width - popupWinWidth) / 2;
            var top = (screen.height - popupWinHeight) / 4;

            var myWindow = window.open(pageURL, pageTitle,
                'resizable=yes, width=' + popupWinWidth +
                ', height=' + popupWinHeight + ', top=' +
                top + ', left=' + left);
        }
    </script>
    @vite('resources/sass/app.scss')
    <style>
        * {
            font-family: 'Lato', sans-serif;
        }

        .text-bebas-h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            font-weight: 500 !important;
        }

        .navbar-dark {
            background: #6a040f !important;
        }

        .navbar-dark .navbar-nav .active>.nav-link {
            color: #FFCF6F !important;
            font-weight: bold !important;
        }
    </style>
    @yield('css')
</head>

<body class="theme-light">
    <div class="page">
        <div class="sticky-top">
            <header class="navbar navbar-expand-md navbar-dark sticky-top d-print-none">
                <div class="container-xl">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar-menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                        <a href=".">
                            Pia Legong
                            {{-- <img src="{{ url('img/logo.png') }}" width="110" height="32" alt="Tabler"

                                class="navbar-brand-image"> --}}
                        </a>
                    </h1>
                    <div class="navbar-nav flex-row order-md-last">
                        @auth
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                                    aria-label="Open user menu">
                                    <span class="avatar avatar-sm rounded-circle"
                                        style="background-image: url(https://eu.ui-avatars.com/api/?background=FFCF6F&color=6a040f&name={{ urlencode(auth()->user()->name) }})"></span>
                                    <div class="d-none d-xl-block ps-2 text-white">
                                        {{ auth()->user()->name ?? null }}
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <a href="{{ route('profile.show') }}" class="dropdown-item">{{ __('Profil Saya') }}</a>
                                    <a class="dropdown-item" href="{{ route('users.index') }}">Pengguna Sistem</a>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" class="dropdown-item"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            <b class="font-bold text-danger">{{ __('Keluar') }}</b>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </header>

            @include('layouts.navigation')

        </div>
        <div class="page-wrapper">

            @yield('content')
        </div>
    </div>
    </div>

    <!-- Core plugin JavaScript-->
    @vite('resources/js/app.js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script type="text/javascript" src="{{ asset('build/datatables.min.js') }}"></script>
    @yield('js')

    <script>
        @if (Session::has('success'))
            Toastify({
                text: "{{ session('success') }}",
                duration: 2400,
                gravity: "bottom",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #80b918, #55a630)",
                },
            }).showToast();
        @endif

        @if (Session::has('error'))
            Toastify({
                text: "{{ session('error') }}",
                duration: 2400,
                gravity: "bottom",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #ef233c, #d90429)",
                },
            }).showToast();
        @endif

        @if (Session::has('warning'))
            Toastify({
                text: "{{ session('warning') }}",
                duration: 2400,
                gravity: "bottom",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #faa307, #f48c06)",
                },
            }).showToast();
        @endif
    </script>

</body>

</html>
