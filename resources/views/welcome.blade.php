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

    .search-form {
        display: flex;
        align-items: center;
    }

    .search-input {
        padding: 10px;
        border-radius: 5px;
        font-size: 16px;
        width: 200px;
    }

    .search-button {
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px;
        margin-left: 5px;
        cursor: pointer;
    }

    .button-model-1 {
        background-color: #28a745;
    }

    .search-button:hover {
        opacity: 0.8;
    }
    .navbar-brand {
        margin-top: -80px;
    }

    .navbar {
        height: 97px;

    }

    .navbar-light .navbar-nav .nav-link {
    color: #FFFFFF;
    font-size: 19px;
    text-transform: uppercase;
    outline: none;
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

    .navbar-light .btn {
    height: 55px;
    text-align: center;
    }

    .navbar-light a.btn {
        height: 55px;
        text-align: center;
    }

     </style>
     <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
         <script>
     function goToWelcomeSection() {
        var container = document.querySelector('.container-xxl');
        container.scrollIntoView({ behavior: 'smooth' });
      }
      window.onload = function() {
        goToWelcomeSection();
      };
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-sucsess" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    @if (!request()->is('login') && !request()->is('register'))
    <nav class="navbar navbar-expand-lg bg-success navbar-light shadow sticky-top p-0">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('storage/img/LOGO.png') }}" alt="PondokJatim" style="height: 250px; width: 280px; margin-top: -27px; margin-left: 73px;">
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto p-4 p-lg-0">

                <a href="{{ request()->routeIs('welcome.index') ? 'active' : '' }}" class="nav-link text-white">
                    <i class="fa-solid fa-house me-1"></i>HOME
                </a>

                <a href="#asatidlist-section" class="nav-link text-white {{ request()->routeIs('asatidlist.index') ? 'active' : '' }}">
                    <i class="fa-solid fa-users text-white me-1"></i> ASATID
                </a>

                <a href="#berita-section" class="nav-link text-white {{ request()->routeIs('berita.index') ? 'active' : '' }}">
                    <i class="fas fa-newspaper text-white  me-1"></i> BERITA
                </a>

                <a href="#gallerie-section" class="nav-link text-white {{ request()->routeIs('gallerie.index') ? 'active' : '' }}">
                    <i class="fa-regular fa-image text-white  me-1"></i>GALLERY
                </a>

            </ul>
            @if (Route::has('register'))
            <li class="nav-item list-unstyled">
            <a href="{{ route('login') }}" class="btn btn-warning btn-lg py-md-3 px-md-4 animated slideInRight {{ request()->routeIs('login') ? 'active' : '' }}">
                LOGIN<i class="fa fa-arrow-right me-3"></i>
            </a>
</li>

@endif

        </div>
    </nav>
    @endif
    <!-- Navbar End -->


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
                                <a href="{{ route('register') }}" class="btn btn-warning py-md-3 px-md-150 animated slideInRight {{ request()->routeIs('register') ? 'active' : '' }}"> BERGABUNG<i class="fa fa-arrow-right me-2"></i></a>
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
                                <h1><a href="{{ route('register') }}" class="btn btn-warning py-md-3 px-md-150 animated slideInRight {{ request()->routeIs('register') ? 'active' : '' }}">BERGABUNG<i class="fa fa-arrow-right me-2"></i></a></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Carousel End -->

        <!-- Start -->
        <div  class="container-xxl py-5">
            <div class="container">
                <div class="row g-4">

                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <i class="fas fa-3x fa-newspaper text-success mb-4"></i>
                                <h5 class="mb-3">ASATID</h5>
                                <p>Jumlah Asatid:{{ $jumlahAsatidlist }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-address-book text-success mb-4"></i>
                                <h5 class="mb-3">BERITA</h5>
                                <p>Jumlah Berita:{{ $jumlahBerita }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-regular fa-image text-success mb-4"></i>
                                <h5 class="mb-3">GALLERY</h5>
                                <p>Jumlah Gallery:{{ $jumlahGallerie }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End -->
        <!-- ASATID Start -->
<div id="asatidlist-section" class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
       {{--  <form method="GET" class="search-form">
            <input type="text" value="{{ $asatid }}" name="asatid" class="search-input">
            <button type="submit" class="search-button button-model-1">
                Cari
            </button>
        </form> --}}
        <div class="text-center">
            <h6 class="section-title bg-white text-center text-success px-3">ASATID</h6>
            <h1 class="mb-5">ASATID</h1>
        </div>
        <div class="row justify-content-center">
            @foreach($asatidlist as $asatiditem)
            <div class="col-md-4 mb-4">
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="{{ asset('storage/'.$asatiditem->foto) }}" style="width: 180px; height: 180px;">
                    <h4 class="mb-0">{{ $asatiditem->nama }}</h4>
                    <h5>{{ $asatiditem->pendidikan }}</h5>
                    <div class="text-white bg-success text-center p-4">
                        <p class="mb-0">{{ $asatiditem->tempat_lahir }}, {{ \Carbon\Carbon::parse($asatiditem->ttl)->isoFormat('D-MMMM-YYYY') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $asatidlist->links() }}
    </div>
</div>
<!-- ASATID End -->

<!-- BERITA -->
     <div id="berita-section" class="container-xxl py-5">
       {{-- <form method="GET" class="search-form">
            <input type="text" value="{{ $cberita }}" name="cberita" class="search-input">
            <button type="submit" class="search-button button-model-1">
                Cari
            </button>
        </form> --}}
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-success px-3">Berita</h6>
                <h1 class="mb-5">Berita</h1>
            </div>
            <div class="row justify-content-center">
                @foreach ($beritas as $key => $berita)
                <div class="col-lg-10 mb-4">
                    <div class="wow fadeInUp" data-wow-delay="0.1s">
                        <div class="position-relative mb-3" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); display: flex;">
                            <div class="overflow-hidden" style="height: 300px; display: flex; max-width: 100%; align-items: center; justify-content: center;">
                                <img class="img-fluid" src="{{ asset('storage/'.$berita->foto) }}" alt="" style="object-fit: cover; height: 100%; align-item: center;">
                            </div>
                            <div class="team-item bg-light border border-top-0 p-4" style="flex: 1; padding-right: 10px;">
                                <div class="mb-2">
                                    <p class="position-relative d-flex btn btn-lg btn-success btn-block">{{ $berita->kategori->nama }}</p>
                                </div>
                                <p class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold">{{ $berita->judul_berita }}</p>
                                <p class="m-0">{{ $berita->slug }}</p>
                                <p class="m-2">{{ \Carbon\Carbon::parse($berita->tanggal)->isoFormat('D-MMMM-YYYY') }}</p>
                                    <div class="d-flex align-items-center">
                                        <small><i class="fa fa-user text-success me-2"></i>{{ $berita->user_posting }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{$beritas->links()}}

        </div>
    </div>
    <!-- END -->

   {{-- gallery start--}}
<div id="gallerie-section" class="container-xxl py-5">
    {{-- <form method="GET" class="search-form">
            <input type="text" value="{{ $cgallerie }}" name="cgallerie" class="search-input">
            <button type="submit" class="search-button button-model-1">
                Cari
            </button>
        </form> --}}
     <div class="container">
        <div class="text-center">
            <h6 class="section-title bg-white text-center text-success px-3">GALLERY</h6>
            <h1 class="mb-5">GALLERY</h1>
          </div>
          {{-- <div class="col-lg-3 mb-4">
            <div class="wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative mb-3" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);"> --}}
        <div class="row g-4 justify-content-center">
            @foreach ($gallerie as $key => $galleris)
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative mb-3" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                        <div class="overflow-hidden" style="display: flex; align-items: center; justify-content: center; width: 100%; height: 300px;">
                            <img class="img-fluid" src="{{ asset('storage/' . $galleris->sampul) }}" alt="" style="object-fit: cover; width: 100%;">
                        </div>
                        <div class="mb-2 ">
                        <a class="position-relative d-flex btn btn-success justify-content-center">{{$galleris->nama_gallery}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{$gallerie->links()}}
    </div>
</div>
{{-- gallery end --}}






        <!-- Footer Start -->
        <div class="container-fluid bg-success text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-white mb-3">INFO FITUR</h4>
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
