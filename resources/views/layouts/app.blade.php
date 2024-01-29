<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <style>
        .navbar {
            background-color: #000;
            border-bottom: 2px solid #000000;
        }

        .navbar-nav .nav-link {
            color: #000000 !important;
            padding: 0.5rem 1rem;
        }

        .navbar-nav .nav-link.active {
            background-color: #5cb85c;
        }

        .dropdown-menu {
            background-color: #000;
        }

        .dropdown-menu a {
            color: #fff !important;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>
<body>
    <div id="app">
        @if (!request()->is('login') && !request()->is('register'))
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('staf.index') ? 'active' : '' }}" href="{{ route('staf.index') }}">
                                <i class="fa-solid fa-user-plus me-1"></i>STAF
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('asatid.index') ? 'active' : '' }}" href="{{ route('asatid.index') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-users me-1"></i>ASATID
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="nav-link dropdown-item {{ request()->routeIs('asatidlist.index') ? 'active' : '' }}" href="{{ route('asatidlist.index') }}">LIST ASATID</a>
                                <a class="nav-link dropdown-item {{ request()->routeIs('mapel.index') ? 'active' : '' }}" href="{{ route('mapel.index') }}">MAPEL</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-regular fa-address-book me-1"></i>SANTRI
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="nav-link dropdown-item {{ request()->routeIs('santri.index') ? 'active' : '' }}" href="{{ route('santri.index') }}">LIST SANTRI</a>
                                <a class="nav-link dropdown-item {{ request()->routeIs('klssantri.index') ? 'active' : '' }}" href="{{ route('klssantri.index') }}">LIST KELAS</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('berita.index') ? 'active' : '' }}" href="{{ route('berita.index') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-newspaper me-1"></i> BERITA
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="nav-link dropdown-item {{ request()->routeIs('kategori.index') ? 'active' : '' }}" href="{{ route('kategori.index') }}">KATEGORI BERITA</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('berita.index') ? 'active' : '' }}" href="{{ route('berita.index') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell me-1"></i> PENGUMUMAN
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="nav-link dropdown-item {{ request()->routeIs('umum.index') ? 'active' : '' }}" href="{{ route('umum.index') }}">PENGUMUMAN UMUM</a>
                                <a class="nav-link dropdown-item {{ request()->routeIs('kelulusan.index') ? 'active' : '' }}" href="{{ route('kelulusan.index') }}">PENGUMUMAN KELULUSAN</a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('gallerie.index') ? 'active' : '' }}" href="{{ route('gallerie.index') }}">GALLERIE</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pendaftaran.index') ? 'active' : '' }}" href="{{ route('pendaftaran.index') }}">PENDAFTARAN</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
