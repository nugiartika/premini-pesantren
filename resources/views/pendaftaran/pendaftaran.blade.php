@extends('layouts.app')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>

        .action-buttons {
            display: flex;
            justify-content: start;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>pendaftaran</h1>
        <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary btn-md mb-3">Daftar</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>nama_lengkap</th>
                    <th>email</th>
                    <th>jenis_kelamin</th>
                    <th>NIK</th>
                    {{-- <th>tempat_lahir</th>
                    <th>tanggal_lahir</th>
                    <th>alamat</th>
                    <th>tempat_tinggal</th>
                    <th>nama_ortu</th>
                    <th>pendidikan_ortu</th>
                    <th>pekerjaan_ortu</th>
                    <th>sekolah_asal</th>
                    <th>telepon_rumah</th> --}}
                    <th>Aksi</th>
                </tr>
            </thead>
            @foreach ($pendaftarans as $key => $pendaftaran)
            <tbody>
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$pendaftaran->nama_lengkap}}</td>
                    <td>{{$pendaftaran->email}}</td>
                    <td>{{$pendaftaran->jenis_kelamin}}</td>
                    <td>{{$pendaftaran->nik}}</td>
                    {{-- <td>{{$pendaftaran->tempat_lahir}}</td>
                    <td>{{$pendaftaran->tanggal_lahir}}</td>
                    <td>{{$pendaftaran->alamat}}</td>
                    <td>{{$pendaftaran->tempat_tinggal}}</td>
                    <td>{{$pendaftaran->nama_ortu}}</td>
                    <td>{{$pendaftaran->pendidikan_ortu}}</td>
                    <td>{{$pendaftaran->pekerjaan_ortu}}</td>
                    <td>{{$pendaftaran->sekolah_asal}}</td>
                    <td>{{$pendaftaran->telepon_rumah}}</td> --}}
                    <td class="d-flex justify-content-start">
                        <div class="action-buttons">
                        <a href="/pendaftaran/{{$pendaftaran->id}}/show" class="btn btn-warning btn-md me-1">Show</a>
                        <a href="/pendaftaran/{{$pendaftaran->id}}/edit" class="btn btn-warning btn-md me-1">Edit</a>
                        <form action="/pendaftaran/{{$pendaftaran->id}}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger btn-md" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                        </div>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</body>


@endsection
