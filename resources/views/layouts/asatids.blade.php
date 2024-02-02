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

                {{-- <li class="nav-item">
                    <a href="{{ route('template.index') }}" class="nav-link {{ request()->routeIs('template.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-plus me-1"></i>HOME
                    </a>
                </li> --}}
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
                                <a href="{{ route('pendaftaran.index') }}" class="btn btn-success py-md-3 px-md-5 animated slideInRight {{ request()->routeIs('pendaftaran.index') ? 'active' : '' }}">DAFTAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="storage/img/HEADER2.jpg" alt="">
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

     <!-- ASATID Start -->
     <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
          <div class="text-center">
            <h6 class="section-title bg-white text-center text-success px-3">ASATID</h6>
            <h1 class="mb-5">ASATID</h1>
          </div>
          <div class="owl-carousel testimonial-carousel position-relative">
            @foreach($asatids as $asatidlist)
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

{{-- Footer start --}}
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
