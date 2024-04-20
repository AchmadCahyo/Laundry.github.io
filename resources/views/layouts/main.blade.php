<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laundry KU</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-1bd03d06.css') }}"> --}}
</head>

<body style="background-color: #C4E4FF">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    Laundry KU
                </a>
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                                @if (Auth::user()->role == 1)
                                    <li class="nav-item dropdown">
                                        <a class="nav-link active dropdown-toggle" aria-current="page"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            href="{{ route('member.index') }}">Member</a>
                                        <ul class="dropdown-menu hover">
                                            <li><a class="dropdown-item" href="{{ route('member.index') }}">Lihat Data
                                                    Member</a></li>
                                            <li><a class="dropdown-item" href="/add">Tambah Data Member</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link active dropdown-toggle" aria-current="page"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            href="{{ route('outlet.index') }}">Outlet</a>
                                        <ul class="dropdown-menu hover">
                                            <li><a class="dropdown-item" href="{{ route('outlet.index') }}">Lihat Data
                                                    Outlet</a></li>
                                            <li><a class="dropdown-item" href="/addo">Tambah Data Outlet</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link active dropdown-toggle" aria-current="page"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            href="{{ route('paket.index') }}">Paket</a>
                                        <ul class="dropdown-menu hover">
                                            <li><a class="dropdown-item" href="{{ route('paket.index') }}">Lihat Data
                                                    Paket</a></li>
                                            <li><a class="dropdown-item" href="/addp">Tambah Data Paket</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link active dropdown-toggle" aria-current="page"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            href="{{ route('pengguna.index') }}">Pengguna</a>
                                        <ul class="dropdown-menu hover">
                                            <li><a class="dropdown-item" href="{{ route('pengguna.index') }}">Lihat
                                                    Data
                                                    Pengguna</a></li>
                                            <li><a class="dropdown-item" href="/addu">Tambah Data Pengguna</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link active dropdown-toggle" aria-current="page"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            href="{{ route('transaksi.index') }}">Transaksi</a>
                                        <ul class="dropdown-menu hover">
                                            <li><a class="dropdown-item" href="{{ route('transaksi.index') }}">Lihat
                                                    Data
                                                    Transaksi</a></li>
                                            <li><a class="dropdown-item" href="/addt">Tambah Data Transaksi</a></li>
                                        </ul>
                                    </li>
                                @elseif (Auth::user()->role == 2)
                                    <li class="nav-item">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link active dropdown-toggle" aria-current="page"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            href="{{ route('member.index') }}">Member</a>
                                        <ul class="dropdown-menu hover">
                                            <li><a class="dropdown-item" href="{{ route('member.index') }}">Lihat Data
                                                    Member</a></li>
                                            <li><a class="dropdown-item" href="/add">Tambah Data Member</a></li>
                                        </ul>
                                    </li>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active dropdown-toggle" aria-current="page"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            href="{{ route('transaksi.index') }}">Transaksi</a>
                                        <ul class="dropdown-menu hover">
                                            <li><a class="dropdown-item" href="{{ route('transaksi.index') }}">Lihat
                                                    Data
                                                    Transaksi</a></li>
                                            <li><a class="dropdown-item" href="/addt">Tambah Data Transaksi</a></li>
                                        </ul>
                                    </li>
                                @elseif (Auth::user()->role == 3)
                                    <li class="nav-item">
                                        <a class="nav-link active"
                                            href="{{ route('transaksi.index') }}">Transaksi</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} | <b>{{ Auth::user()->outlet->name }}</b>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    {{-- <script src="{{ asset('build/assets/app-911e262d.js') }}"></script> --}}
</body>

</html>
