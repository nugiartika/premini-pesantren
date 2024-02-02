<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PONDOK JATIM</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

     <style>
         /* CSS untuk container kolom */
     .col-lg-5 {
         padding: 0;
     }

     /* CSS untuk baris dalam kolom */
     .row.mx-0 {
         margin-left: 0;
         margin-right: 0;
     }

     /* CSS untuk gambar */
     .position-relative.overflow-hidden {
         height: 250px;
     }

     .img-fluid.w-100.h-100 {
         object-fit: cover;
     }

     /* CSS untuk overlay */
     .overlay {
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background: rgba(0, 0, 0, 0.5);
         display: flex;
         flex-direction: column;
         justify-content: flex-end;
         padding: 20px;
     }

     .overlay .mb-2 {
         display: flex;
         align-items: center;
     }

     .overlay a.badge {
         background-color: #000000;
         color: #fff;
         text-decoration: none;
         padding: 0.5rem;
         margin-right: 0.5rem;
     }

     .overlay a.text-white {
         color: #fff;
         text-decoration: none;
     }

     /* CSS untuk judul berita */
     .overlay a.h6 {
         color: #fff;
         text-decoration: none;
         font-size: 1.25rem;
         font-weight: 600;
         margin-top: 0.5rem;
         margin-bottom: 0;
     }

     </style>
     <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    @if (!request()->is('login') && !request()->is('register'))
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-success navbar-light shadow sticky-top p-0">
        {{-- <a href="{{ url('index.html') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h5 class="m-0 text-success"><i class="fa-regular fa-house"></i>PONDOK JATIM</h5>
        </a> --}}
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto p-4 p-lg-0">

                {{-- <li class="nav-item">
                    <a href="{{ route('template.index') }}" class="nav-link {{ request()->routeIs('template.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-plus me-1"></i>HOME
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('staf.index') }}" class="nav-link text-white {{ request()->routeIs('staf.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-plus text-white me-1"></i>STAF
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('asatidlist.index') }}" class="nav-link text-white {{ request()->routeIs('asatidlist.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-users text-white me-1"></i>ASATID
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white {{ request()->routeIs(['santri.index', 'klssantri.index', 'syahriah.index']) ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa-regular fa-address-book text-white me-1"></i>SANTRI
                    </a>
                    <div class="dropdown-menu bg-success" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item text-white  {{ request()->routeIs('pendaftaran.index') ? 'active' : '' }}" href="{{ route('pendaftaran.index') }}">PENDAFTARAN</a>
                      <a class="dropdown-item text-white  {{ request()->routeIs('santri.index') ? 'active' : '' }}" href="{{ route('santri.index') }}">LIST SANTRI</a>
                      <a class="dropdown-item text-white  {{ request()->routeIs('klssantri.index') ? 'active' : '' }}" href="{{ route('klssantri.index') }}">LIST KELAS</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('berita.index') }}" class="nav-link text-white  {{ request()->routeIs('berita.index') ? 'active' : '' }}">
                        <i class="fas fa-newspaper text-white  me-1"></i> BERITA
                    </a>
<<<<<<< HEAD
                    <div class="dropdown-menu" aria-labelledby="santriDropdown">
                        <a class="dropdown-item {{ request()->routeIs('santri.index') ? 'active' : '' }}" href="{{ route('santri.index') }}">LIST SANTRI</a>
                        <a class="dropdown-item {{ request()->routeIs('klssantri.index') ? 'active' : '' }}" href="{{ route('klssantri.index') }}">LIST KELAS</a>
                        <a class="dropdown-item {{ request()->routeIs('syahriah.index') ? 'active' : '' }}" href="{{ route('syahriah.index') }}">SYAHRIAH</a>
                    </div>
                </li> --}}

                {{-- <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs(['detailberita.index', 'kategori.index']) ? 'active' : '' }}" id="beritaDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-newspaper me-1"></i> BERITA
                    </a>
                    <div class="dropdown-menu" aria-labelledby="beritaDropdown">
                        <a class="dropdown-item {{ request()->routeIs('detailberita.index') ? 'active' : '' }}" href="{{ route('detailberita.index') }}">LIST BERITA</a>
                        <a class="dropdown-item {{ request()->routeIs('kategori.index') ? 'active' : '' }}" href="{{ route('kategori.index') }}">KATEGORI BERITA</a>
                    </div>
                </li> --}}
=======
                </li>
>>>>>>> fc259cd7d164e35a2bca017119a214f918f627f4

                {{-- <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs(['umum.index', 'kelulusan.index']) ? 'active' : '' }}" id="pengumumanDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell me-1"></i> PENGUMUMAN
                    </a>
                    <div class="dropdown-menu" aria-labelledby="pengumumanDropdown">
                        <a class="dropdown-item {{ request()->routeIs('umum.index') ? 'active' : '' }}" href="{{ route('umum.index') }}">PENGUMUMAN UMUM</a>
                        <a class="dropdown-item {{ request()->routeIs('kelulusan.index') ? 'active' : '' }}" href="{{ route('kelulusan.index') }}">PENGUMUMAN KELULUSAN</a>
                    </div>
                </li> --}}
{{--
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('detailberita.index') ? 'active' : '' }}" href="{{ route('detailberita.index') }}">
                        <i class="fa-regular fa-image me-1"></i>BERITA
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link text-white  {{ request()->routeIs('gallerie.index') ? 'active' : '' }}" href="{{ route('gallerie.index') }}">
                        <i class="fa-regular fa-image text-white  me-1"></i>GALLERIE
                    </a>
                </li>

            </ul>
            @if (Route::has('register'))
            <li class="nav-item list-unstyled">
                <a href="{{ route('register') }}" class="btn btn-warning text-white  py-4 px-lg-5 d-none d-lg-block">
                    BERGABUNG <i class="fa fa-arrow-right ms-3"></i>
                </a>
            </li>
            @endif
        </div>
    </nav>
    <!-- Navbar End -->
@endif



    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="storage/img/HEADER1.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style=";">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                {{-- <h5 class="text-success text-uppercase mb-3 animated slideInDown">TAHUN AJARAN 2024 - 2025.</h5>
                                <h1 class="display-3 text-white animated slideInDown style=";>PENDAFTARAN</h1>
                                <h1 class="display-3 text-white animated slideInDown">SANTRI BARU</h1> --}}
                                <a href="{{ route('pendaftaran.index') }}" class="btn btn-warning py-md-3 px-md-5 text-white  animated slideInRight {{ request()->routeIs('pendaftaran.index') ? 'active' : '' }}">DAFTAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="storage/img/HEADER2.png" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                {{-- <h5 class="text-success text-uppercase mb-3 animated slideInDown">TAHUN AJARAN 2024 - 2025</h5>
                                <h1 class="display-3 text-black animated slideInDown">DARI SANTRI UNTUK SANTRI</h1> --}}
                                <a href="{{ route('pendaftaran.index') }}" class="btn btn-warning py-md-3 px-md-5 text-white  animated slideInRight {{ request()->routeIs('pendaftaran.index') ? 'active' : '' }}">DAFTAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Carousel End -->

        <!-- Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-user-plus text-success mb-4"></i>
                                <h5 class="mb-3">STAF</h5>
                                <p>Jumlah Staf:{{ $jumlahStaf }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-users text-success mb-4"></i>
                                <h5 class="mb-3">ASATID</h5>
                                <p>Jumlah Asatid:{{ $jumlahAsatid }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-address-book text-success mb-4"></i>
                                <h5 class="mb-3">SANTRI</h5>
                                <p>Jumlah Santri:{{ $jumlahSantri }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-chalkboard-teacher text-success mb-4"></i>
                                <h5 class="mb-3">KELAS</h5>
                                <p>Jumlah Kelas:{{ $jumlahKelas }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End -->

<<<<<<< HEAD

    <!-- About Start -->
    {{-- <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="img/about.jpg" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                    <h1 class="mb-4">Welcome to eLEARNING</h1>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Skilled Instructors</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Online Classes</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>International Certificate</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Skilled Instructors</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Online Classes</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>International Certificate</p>
                        </div>
                    </div>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="">Read More</a>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- About End -->


    <!-- berita Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Gallery</h6>
                <h1 class="mb-5">Gallery</h1>
=======
    <!-- Berita Start -->
    <div class="container-xxl py-5 category">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-success px-3">BERITA</h6>
                <h1 class="mb-5 text-success">BERITA</h1>
>>>>>>> fc259cd7d164e35a2bca017119a214f918f627f4
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($galleris as $key => $gallery)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item bg-light" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                            <div class="overflow-hidden" style="height: 300px; display: flex; align-items: center; justify-content: center;">
                                <img class="img-fluid" src="{{ asset('storage/' . $gallery->sampul) }}" alt="" style="object-fit: cover; height: 100%;">
                            </div>
<<<<<<< HEAD


                                            {{-- <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                                                <div class="bg-light d-flex justify-content-center pt-2 px-1"> --}}
                                    <div class="mb-2 ">
                                    <a class="position-relative d-flex btn btn-primary justify-content-center">{{$gallery->nama_gallery}}</a>
                                    </div>
                                        {{-- </div> --}}
                                        {{-- <div class="text-center p-4">
                                            <h5 class="mb-0"></h5>
                                            <small>{{$gallery->slug}}</small>
                                        </div> --}}
                                        {{-- <div class="text-left p-1" style="padding: 20px 23px; font-family: Roboto Slab, Sans-serif; font-size: 12px; font-weight: 400;">
                                            <p>{{$berita->tanggal}}</p>
                                        </div> --}}
                                        {{-- <div class="d-flex border-top">
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i>{{ $gallery->tanggal }}</small>
                                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>{{ $gallery->user_posting }}</small>
                                        </div> --}}
=======
                            <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                                <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                    <a class="btn btn-lg btn-success btn-block">{{$gallery->nama_gallery}}</a>
                                </div>
                            </div>
                            <div class="text-center p-4">
                                <h5 class="mb-0"></h5>
                                <small>{{$gallery->slug}}</small>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-success me-2"></i>{{ $gallery->tanggal }}</small>
                                <small class="flex-fill text-center py-2"><i class="fa fa-user text-success me-2"></i>{{ $gallery->user_posting }}</small>
                            </div>
>>>>>>> fc259cd7d164e35a2bca017119a214f918f627f4
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

<<<<<<< HEAD
                    {{-- @foreach ($beritas as $key => $berita)
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="{{ asset('storage/' . $berita->foto) }}" alt="">
                                <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                                    <h5 class="m-0">{{$berita->judul_berita}}</h5>
                                    <small class="text-primary">49 Courses</small>
                                </div>
                            </a>
                        </div>
                        @endforeach --}}
    {{-- berita end --}}

    <!-- Courses Start -->
    <div class="container-xxl py-5">
=======
    <div class="container-fluid">
>>>>>>> fc259cd7d164e35a2bca017119a214f918f627f4
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Berita</h6>
                <h1 class="mb-5">Berita</h1>
            </div>
            <div class="row justify-content-center">

                @foreach ($beritas as $key => $berita)
                <div class="col-lg-3 mb-4">
                    {{-- <a href="{{ route('detailberita.index', ['id' => $berita->id]) }}"> --}}
                        <div class="wow fadeInUp" data-wow-delay="0.1s">
                            <div class="position-relative mb-3" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">

                                <div class="overflow-hidden" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                                <img class="img-fluid" src="{{ asset('storage/'.$berita->foto) }}" alt=""  style="object-fit: cover; height: 100%;">
                                </div>
                                <div class="team-item bg-l                                                                                                         ight border border-top-0 p-4">

                                    {{-- <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                                        <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                            <a class="btn btn-lg btn-primary btn-block">{{$berita->kategori->nama}}</a>
                                        </div>
                                    </div>--}}
                                    <div class="mb-2">
<<<<<<< HEAD
                                        <p class="position-relative d-flex btn btn-primary justify-content-center">{{ $berita->kategori->nama }}</p>
                                        {{-- <a class="text-body" href=""><small>{{ $berita->tanggal }}</small></a> --}}
                                    </div>
                                    <p class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" >{{ $berita->judul_berita }}</p>
=======
                                        <a class="badge badge-success text-uppercase font-weight-semi-bold p-2 mr-2"
                                            href="">Business</a>
                                    </div>
                                    <a class="h4 d-block mb-3 text-success text-uppercase font-weight-bold" href="">{{ $berita->judul_berita }}</a>
>>>>>>> fc259cd7d164e35a2bca017119a214f918f627f4
                                    <p class="m-0">{{$berita->slug}}</p>
                                </div>
                                <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                    <div class="d-flex align-items-center">
<<<<<<< HEAD
                                        {{-- <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25" alt=""> --}}
                                        <small><i class="fa fa-user text-primary me-2"></i>{{ $berita->user_posting }}</small>
=======
                                        <small>{{ $berita->user_posting }}</small>
>>>>>>> fc259cd7d164e35a2bca017119a214f918f627f4
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <small class="ml-3">{{ \Carbon\Carbon::parse($berita->tanggal)->isoFormat('D-MMMM-YYYY') }}</small>
                                    </div>
                                </div>
                            </div>
<<<<<<< HEAD
=======
                            @endforeach
>>>>>>> fc259cd7d164e35a2bca017119a214f918f627f4
                        </div>
                    {{-- </a> --}}
                            </div>
                            @endforeach
            </div>
                        {{-- </div>
                    </div> --}}
                </div>
            </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
    <!-- berita End -->

   {{-- staf --}}
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-6">
                        @foreach ($staf as $key => $staf)
                        <div class="position-relative mb-3">
                            <img class="img-fluid" src="{{ asset('storage/'.$staf->foto) }}" alt=""
                                style="object-fit: cover; height: 100%;">
                            <div class="bg-white border border-top-0 p-4">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                        href="#">Business</a>
                                    {{-- <a class="text-body" href=""><small>{{ $berita->tanggal }}</small></a> --}}
                                </div>
                                <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold"
                                    href="">{{ $staf->nama }}</a>
                                <p class="m-0">{{ $staf->nip }}</p>
                            </div>

                            <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                <div class="d-flex align-items-center">
                                    {{-- <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25" alt=""> --}}
                                    <small>{{ $staf->jabatan }}</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <small class="ml-3">
                                        {{ \Carbon\Carbon::parse($staf->ttl)->isoFormat('D-MMMM-YYYY') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- staf --}}



    {{-- <div class="container-xxl py-5">
=======
    <!-- Berita End -->










    <!-- STAF -->
    <div class="container-xxl py-5">
>>>>>>> fc259cd7d164e35a2bca017119a214f918f627f4
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">STAF</h6>
                <h1 class="mb-5">STAF</h1>
            </div>
            <div class="row g-4">
                @foreach ($staf as $key => $staf)
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{ asset('storage/' . $staf->foto) }}" alt="">
                        </div>
                         <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <h5 class="mb-0"><a class="btn btn-success btn-lg text-white btn-block">{{$staf->nama}}</a></h5>
                            </div>
                        </div>
                       <div class="text-center p-4">
                            <small><a class="btn btn-lg text-black btn-block">{{$staf->jabatan}}</a></small>
                            <small><a class="btn btn-lg text-black btn-block " style="font-size: 15px;">{{ $staf->tempat_lahir }} {{ \Carbon\Carbon::parse($staf->ttl)->isoFormat('D-MMMM-YYYY') }}</a></small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
<<<<<<< HEAD
    </div>--}}



    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Instructors</h6>
                <h1 class="mb-5">Expert Instructors</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-1.jpg" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Instructor Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-2.jpg" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Instructor Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-3.jpg" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Instructor Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-4.jpg" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Instructor Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->
=======
    </div>
    <!-- STAF End -->
>>>>>>> fc259cd7d164e35a2bca017119a214f918f627f4
    <!-- Carousel End -->


    <!-- ASATID Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
          <div class="text-center">
            <h6 class="section-title bg-white text-center text-success px-3">ASATID</h6>
            <h1 class="mb-5">ASATID</h1>
          </div>
          <div class="owl-carousel testimonial-carousel position-relative">
            @foreach($asatidlist as $asatidlist)
            <div class="testimonial-item text-center">
              <img class="border rounded-circle p-2 mx-auto mb-3" src="{{ asset('storage/'.$asatidlist->foto) }}" style="width: 80px; height: 80px;">
              <h5 class="mb-0">{{ $asatidlist->nama }}</h5>
              <p>{{ $asatidlist->pendidikan }}</p>
              <div class="text-white bg-success text-center p-4">
                <p class="mb-0">{{ $asatidlist->tempat_lahir }}, {{ \Carbon\Carbon::parse($asatidlist->ttl)->isoFormat('D-MMMM-YYYY') }}</p>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    <!-- ASATID End -->


        <!-- Footer Start -->
        <div class="container-fluid bg-success text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-white mb-3">INFO FITUR</h4>
                        <a class="btn btn-link" href="{{ route('staf.index') }}">STAF</a>
                        <a class="btn btn-link" href="{{ route('asatidlist.index') }}">ASATID</a>
                        <a class="btn btn-link" href="{{ route('pendaftaran.index') }}">PENDAFTARAN</a>
                        <a class="btn btn-link" href="{{ route('santri.index') }}">SANTRI</a>
                        <a class="btn btn-link" href="{{ route('klssantri.index') }}">KELAS</a>
                        <a class="btn btn-link" href="{{ route('berita.index') }}">BERITA</a>
                        <a class="btn btn-link" href="{{ route('gallerie.index') }}">GALERY</a>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-white mb-3">KONTAK</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>JL.KH..Hasyim Asy'ari RT:34 RW:11 JATIM</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 333 333</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>pondokjatim@gmail.com</p>
                        <div class="d-flex justify-content-center pt-2 px-1">
                          <a class="btn btn-sm btn-square mx-1" href=""><i class="fab fa-facebook-f text-white"></i></a>
                          <a class="btn btn-sm btn-square mx-1" href=""><i class="fab fa-twitter text-white"></i></a>
                          <a class="btn btn-sm btn-square mx-1" href=""><i class="fab fa-instagram text-white"></i></a>
                        </div>
                      </div>

                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-white mb-3">GALLERY</h4>
                        <div class="row g-2 pt-2">
                          <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('storage/img/FOOTER1.jpg') }}" alt="" style="width: 100%; height: auto;">
                          </div>
                          <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('storage/img/FOOTER2.jpg') }}" alt="" style="width: 100%; height: auto;">
                          </div>
                          <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('storage/img/FOOTER3.jpg') }}" alt="" style="width: 100%; height: auto;">
                          </div>
                          <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('storage/img/FOOTER4.jpg') }}" alt="" style="width: 100%; height: auto;">
                          </div>
                          <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('storage/img/FOOTER5.jpg') }}" alt="" style="width: 100%; height: auto;">
                          </div>
                          <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('storage/img/FOOTER6.jpg') }}" alt="" style="width: 100%; height: auto;">
                          </div>
                        </div>
                      </div>

                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">PONDOKJATIM</a>, Hak cipta dilindungi undang-undang.

                            Dirancang Oleh <a class="border-bottom" href="#">SANTRI</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->





    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-success btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>
