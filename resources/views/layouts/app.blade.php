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

    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <style>

        .navbar {
            height: 83px;
        }

        .img img {
                width: 1232px;
                height: 302px;
            }

        .navbar-toggler-icon {
            width: 1.5em;
            height: 1.5em;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
            font-size: 14px;
            padding: .5rem 1rem;
        }

        .dropdown-menu a {
            color: #ffffff;
            background-color: #28a745;
        }

        .navbar-nav .nav-link.active {
            background-color: #ADBC9F;
        }

        /* table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        } */

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #ffffff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .btn-success,
        .btn-warning,
        .btn-danger {
            font-size: 15px;
        }

        .nav-item.dropdown .nav-link {
            color: rgb(255, 255, 255);
        }


        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:hover {
            color: rgb(255, 255, 255);
            background-color: #ADBC9F;
        }
        tr:hover {
            background-color: white;
            color: rgb(33, 168, 53);
        }

        .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 20px 0;
        }

.pagination .page-item:not(.active) .page-link {
                color: black;
                background-color: #f8f9fa;
                border-color: #dee2e6;
            }
                .pagination .page-item.active .page-link {
                background-color: black;
                border-color: black;
                color: white;
            }

    .pagination .page-item:not(.active) .page-link {
        color: black;
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
        .pagination .page-item.active .page-link {
        background-color: rgb(0, 0, 0);
        border-color: black;
        color: white;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div id="app">

        @if (!request()->is('login') && !request()->is('register'))
    @php
        $role = auth()->user()->role;
    @endphp
        @if ($role == 'admin')
        <nav class="navbar navbar-expand-lg btn-success">

            <a class="navbar-brand" href="#">
                <img src="{{ asset('storage/img/LOGO.png') }}" alt="PondokJatim" style="height: 215px;
                width: 215px;
                margin-top: 48px;
                margin-left: 26px;"
    >
            </a>
            <div class="container">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">

                        @auth

                            <li class="nav-item">
                                @if ($role == 'admin')
                                    <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                                        href="{{ route('dashboard.index') }}">
                                        <i class="fa-solid fa-house me-1"></i>DASHBOARD
                                    </a>
                                @else
                                    <a class="nav-link {{ request()->routeIs('home.index') ? 'active' : '' }}"
                                        href="{{ route('home.index') }}">
                                        DASHBOARD
                                    </a>
                                @endif

                            </li>

                            @if ($role == 'admin')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('staf.index') ? 'active' : '' }}"
                                        href="{{ route('staf.index') }}">
                                        <i class="fa-solid fa-user-plus me-1"></i>STAF
                                    </a>
                                </li>
                            @endauth

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->routeIs(['asatid.index','asatidlist.index', 'mapel.index']) ? 'active' : '' }}"
                                    href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-users me-1"></i>ASATID
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="nav-link dropdown-item {{ request()->routeIs('asatid.index') ? 'active' : '' }}"
                                        href="{{ route('asatid.index') }}">ASATID</a>
                                    <a class="nav-link dropdown-item {{ request()->routeIs('asatidlist.index') ? 'active' : '' }}"
                                        href="{{ route('asatidlist.index') }}">LIST ASATID</a>
                                    <a class="nav-link dropdown-item {{ request()->routeIs('mapel.index') ? 'active' : '' }}"
                                        href="{{ route('mapel.index') }}">MAPEL</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->routeIs(['santri.index', 'klssantri.index', 'syahriah.index']) ? 'active' : '' }}"
                                    href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-regular fa-address-book me-1"></i>SANTRI
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="nav-link dropdown-item {{ request()->routeIs('santri.index') ? 'active' : '' }}"
                                        href="{{ route('santri.index') }}">LIST SANTRI</a>
                                    <a class="nav-link dropdown-item {{ request()->routeIs('klssantri.index') ? 'active' : '' }}"
                                        href="{{ route('klssantri.index') }}">LIST KELAS</a>
                                </div>
                            </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs(['berita.index', 'kategori.index']) ? 'active' : '' }}"
                                href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-newspaper me-1"></i> BERITA
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="nav-link dropdown-item {{ request()->routeIs('berita.index') ? 'active' : '' }}"
                                    href="{{ route('berita.index') }}">LIST BERITA</a>
                                <a class="nav-link dropdown-item {{ request()->routeIs('kategori.index') ? 'active' : '' }}"
                                    href="{{ route('kategori.index') }}">KATEGORI BERITA</a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('kelulusan.index') ? 'active' : '' }}"
                                href="{{ route('kelulusan.index') }}">
                                <i class="fas fa-bell me-1"></i>KELULUSAN
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('gallerie.index') ? 'active' : '' }}"
                                href="{{ route('gallerie.index') }}"><i
                                    class="fa-regular fa-image me-1"></i>GALLERIE</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pendaftaran.index') ? 'active' : '' }}"
                                href="{{ route('pendaftaran.index') }}"><i
                                    class="fas fa-clipboard me-1"></i>PENDAFTARAN</a>
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item logout-item" href="{{ route('logout') }}"
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
        @else

        <nav class="navbar navbar-expand-lg btn-success">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('storage/img/LOGO.png') }}" alt="PondokJatim" style="height: 215px;
                    width: 215px;
                    margin-top: 48px;
                    margin-left: 26px;"
        >
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home.index') ? 'active' : '' }}" href="{{ route('home.index') }}"><i class="fa-solid fa-house me-1"></i>HOME</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('berita.index') ? 'active' : '' }}" href="{{ route('berita.index') }}"><i class="fas fa-newspaper me-1"></i>BERITA</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('gallerie.index') ? 'active' : '' }}" href="{{ route('gallerie.index') }}"><i class="fa-regular fa-image me-1"></i>GALLERIE</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('kelulusan.index') ? 'active' : '' }}"
                                href="{{ route('kelulusan.index') }}">
                                <i class="fas fa-bell me-1"></i>KELULUSAN
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pendaftaran.index') ? 'active' : '' }}" href="{{ route('pendaftaran.index') }}"><i class="fas fa-clipboard me-1"></i>PENDAFTARAN</a>
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item logout-item" href="{{ route('logout') }}"
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

        @endif
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>

</html>
