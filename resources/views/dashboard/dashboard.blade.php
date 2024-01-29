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
        section {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin: 20px; /* Menambahkan margin agar lebih terlihat rapi */
        }

        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
            width: 300px;
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        h2 {
            color: #333;
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        p {
            color: #666;
            font-size: 1em;
            line-height: 1.4;
        }

        /* Menambahkan class .full-height untuk tinggi maksimum kartu */
        .full-height {
            height: 100%; /* Mengisi tinggi sesuai tinggi maksimum */
        }

        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>


        <section>
            <a href="room.php" class="card-link">
                <div class="card">
                    <h2>Staf</h2>
                    <p>Jumlah Staf: {{ $jumlahStaf }}</p>
                </div>
            </a>

            <a href="room.php" class="card-link">
                <div class="card">
                    <h2>Asatid</h2>
                    <p>Jumlah Asatid: {{ $jumlahAsatid }}</p>
                </div>
            </a>

            <a href="room.php" class="card-link">
                <div class="card">
                    <h2>Santri</h2>
                    <p>Jumlah Santri: {{ $jumlahSantri }}</p>
                </div>
            </a>

            <a href="room.php" class="card-link">
                <div class="card">
                    <h2>Kelas</h2>
                    <p>Jumlah Kelas: {{ $jumlahKelas }}</p>
                </div>
            </a>

            <a href="room.php" class="card-link">
                <div class="card">
                    <h2>Galery</h2>
                    <p>Jumlah Gallery: {{ $jumlahGallery }}</p>
                </div>
            </a>

            <a href="room.php" class="card-link">
                <div class="card">
                    <h2>Berita</h2>
                    <p>Jumlah Berita: {{ $jumlahBerita }}</p>
                </div>
            </a>

            <a href="room.php" class="card-link">
                <div class="card">
                    <h2>Kelulusan</h2>
                    <p>Jumlah Kelulusan: {{ $jumlahKelulusan }}</p>
                </div>
            </a>

            <a href="room.php" class="card-link">
                <div class="card">
                    <h2>Pengumuman</h2>
                    <p>Jumlah Pengumuman: {{ $jumlahPengumuman }}</p>
                </div>
            </a>
        </section>
        {{-- <footer> --}}
            <!-- Footer content -->
        {{-- </footer> --}}

@endsection

