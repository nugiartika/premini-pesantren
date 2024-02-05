@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">SUCCESS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ session('success') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#successModal').modal('show');
            });
        </script>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif



    <style>
         body{
           background-color:#8FBC8F;
           background-image: url({{ asset('storage/img/BGG2.png') }});
           background-size: 100% 100%;
    }
        .img {
            position: relative;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            transform: translate(20%, 0);
        }

        .img img {
            width: 50%;
        }

        section {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin: 20px;
            padding-left: 20%;
            padding-right: 20%;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .card {
            background-color: #272829;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
            width: 250px;
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }

        h2 {
            color: #ffffff;
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        p {
            color: #ffffff;
            font-size: 1em;
            line-height: 1.4;
        }

        .tb {
            border: none;
            color: #2bff00;
        }
        .tb.no-bootstrap-table tr {
        background-color: transparent;
    }



    </style>
<body>
        <section>
            <table class="tb no-bootstrap-table" >

                    <td>
                        <a href="{{ route('staf.index') }}" class="card-link">
                            <div class="card">
                                <h2><i class="fa-solid fa-user-plus me-1"></i>STAF</h2>
                                <p>Jumlah Staf: {{ $jumlahStaf }}</p>
                            </div>
                        </a>
                    </td>

                    <td>
                        <a href="{{ route('asatid.index') }}" class="card-link">
                            <div class="card">
                                <h2><i class="fa-solid fa-users me-1"></i>ASATID</h2>
                                <p>Jumlah Asatid: {{ $jumlahAsatid }}</p>
                            </div>
                        </a>
                    </td>

                    <td>
                        <a href="{{ route('santri.index') }}" class="card-link">
                            <div class="card">
                                <h2> <i class="fa-regular fa-address-book me-1"></i>SANTRI</h2>
                                <p>Jumlah Santri: {{ $jumlahSantri }}</p>
                            </div>
                        </a>
                    </td>

                    <td>
                        <a href="{{ route('klssantri.index') }}" class="card-link">
                            <div class="card">
                                <h2><i class="fa-brands fa-odnoklassniki me-1"></i>KELAS</h2>
                                <p>Jumlah Kelas: {{ $jumlahKelas }}</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="{{ route('gallerie.index') }}" class="card-link">
                            <div class="card">
                                <h2><i class="fa-regular fa-image me-1"></i>GALERY</h2>
                                <p>Jumlah Gallery: {{ $jumlahGallery }}</p>
                            </div>
                        </a>
                    </td>

                    <td>
                        <a href="{{ route('berita.index') }}" class="card-link">
                            <div class="card">
                                <h2> <i class="fas fa-newspaper me-1"></i> BERITA</h2>
                                <p>Jumlah Berita: {{ $jumlahBerita }}</p>
                            </div>
                        </a>
                    </td>

                    <td>
                        <a href="{{ route('kelulusan.index') }}" class="card-link">
                            <div class="card">
                                <h2><i class="fas fa-bell me-1"></i>KELULUSAN</h2>
                                <p>Jumlah Kelulusan: {{ $jumlahKelulusan }}</p>
                            </div>
                        </a>
                    </td>

                </tr>
        </table>
        </section>
@endsection
</body>

