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
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
     {{-- <link href="css/style2.css" rel="stylesheet"> --}}
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

     /* CSS untuk badge dan tanggal */
     .overlay .mb-2 {
         display: flex;
         align-items: center;
     }

     .overlay a.badge {
         background-color: #007bff;
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

.team-item {
    position: relative; /* Membuat posisi relatif untuk elemen ini */
}

.down {
    position: absolute;
    bottom: 0;
    width: 100%;
}

/* Menambahkan gaya overflow agar teks tidak keluar dari card */
.team-item p {
    overflow: hidden;
    text-overflow: ellipsis; /* Menambahkan titik tiga (...) jika teks terlalu panjang */
    white-space: nowrap; /* Mencegah wrap teks */
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
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        {{-- <a href="{{ url('index.html') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h5 class="m-0 text-success"><i class="fa-regular fa-house"></i>PONDOK JATIM</h5>
        </a> --}}
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto p-4 p-lg-0">

                <li class="nav-item">
                    <a href="{{ route('staf.index') }}" class="nav-link {{ request()->routeIs('staf.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-plus me-1"></i>STAF
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs(['asatidlist.index', 'mapel.index']) ? 'active' : '' }}" id="asatidDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-users me-1"></i>ASATID
                    </a>
                    <div class="dropdown-menu" aria-labelledby="asatidDropdown">
                        <a class="dropdown-item {{ request()->routeIs('asatidlist.index') ? 'active' : '' }}" href="{{ route('asatidlist.index') }}">LIST ASATID</a>
                        <a class="dropdown-item {{ request()->routeIs('mapel.index') ? 'active' : '' }}" href="{{ route('mapel.index') }}">MAPEL</a>
                    </div>
                </li>

                {{-- <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs(['santri.index', 'klssantri.index', 'syahriah.index']) ? 'active' : '' }}" id="santriDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-regular fa-address-book me-1"></i>SANTRI
                    </a>
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

                {{-- <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs(['umum.index', 'kelulusan.index']) ? 'active' : '' }}" id="pengumumanDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell me-1"></i> PENGUMUMAN
                    </a>
                    <div class="dropdown-menu" aria-labelledby="pengumumanDropdown">
                        <a class="dropdown-item {{ request()->routeIs('umum.index') ? 'active' : '' }}" href="{{ route('umum.index') }}">PENGUMUMAN UMUM</a>
                        <a class="dropdown-item {{ request()->routeIs('kelulusan.index') ? 'active' : '' }}" href="{{ route('kelulusan.index') }}">PENGUMUMAN KELULUSAN</a>
                    </div>
                </li> --}}

                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('detailberita.index') ? 'active' : '' }}" href="{{ route('detailberita.index') }}">
                        <i class="fa-regular fa-image me-1"></i>BERITA
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('gallerie.index') ? 'active' : '' }}" href="{{ route('gallerie.index') }}">
                        <i class="fa-regular fa-image me-1"></i>GALLERIE
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pendaftaran.index') ? 'active' : '' }}" href="{{ route('pendaftaran.index') }}">
                        <i class="fas fa-clipboard me-1"></i>PENDAFTARAN
                    </a>
                </li>
            </ul>
            @if (Route::has('register'))
            <li class="nav-item list-unstyled">
                <a href="{{ route('register') }}" class="btn btn-success py-4 px-lg-5 d-none d-lg-block">
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
                                <a href="{{ route('pendaftaran.index') }}" class="btn btn-success py-md-3 px-md-5 animated slideInRight {{ request()->routeIs('pendaftaran.index') ? 'active' : '' }}">DAFTAR</a>
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
                                <a href="{{ route('pendaftaran.index') }}" class="btn btn-success py-md-3 px-md-5 animated slideInRight {{ request()->routeIs('pendaftaran.index') ? 'active' : '' }}">DAFTAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Carousel End -->


    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Berita</h6>
                <h1 class="mb-5">Berita</h1>
            </div>
            <div class="row justify-content-center">

                @foreach ($beritas as $key => $berita)
                <div class="col-lg-10 mb-4">
                    {{-- <a href="{{ route('detailberita.index', ['id' => $berita->id]) }}"> --}}
                        <div class="wow fadeInUp" data-wow-delay="0.1s">
                            <div class="position-relative mb-3" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); display: flex;">
                                <div class="overflow-hidden " style="height: 300px; display: flex; max-width: 100%;  align-items: center; justify-content: center;">
                                <img class="img-fluid" src="{{ asset('storage/'.$berita->foto) }}" alt=""  style="object-fit: cover; height: 100%; align-item: center;">
                                </div>
                                <div class="team-item bg-light border border-top-0 p-4" style="flex: 1; padding-right: 10px;">
                                    <div class="mb-2">
                                        <p class="position-relative d-flex btn btn-lg btn-primary btn-block">{{ $berita->kategori->nama }}</p>
                                    </div>
                                    <p class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" >{{ $berita->judul_berita }}</p>
                                    <p class="m-0">{{$berita->slug}}</p>
                                    <div class="d-flex justify-content-between down" style="position: absolute; bottom: 15px; width: 95%;">
                                        <div class="d-flex align-items-center">
                                            <small><li class="fa fa-user text-primary me-2"></li>{{ $berita->user_posting }}</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <small class="ml-3">
                                                {{ \Carbon\Carbon::parse($berita->tanggal)->isoFormat('D-MMMM-YYYY') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                    <div class="d-flex align-items-center">
                                                                          </div>
                                </div> --}}
                            </div>
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
    <!-- berita End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Privacy Policy</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">FAQs & Help</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-1.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-1.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->





    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


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