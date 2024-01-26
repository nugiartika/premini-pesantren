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
        {{-- <a href="{{ route('pendaftaran.pendaftaran') }}" class="btn btn-primary btn-md mb-3">Daftar</a> --}}
        <button type="button" class="btn btn-primary btn-md me-1" data-bs-toggle="modal" data-bs-target="#tambahdaftar">
            daftar
        </button>
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
            @foreach ($pendaftaran as $key => $pendaftaran)
            <tbody>
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$pendaftaran->nama_lengkap}}</td>
                    <td>{{$pendaftaran->email}}</td>
                    <td>{{$pendaftaran->jenis_kelamin}}</td>
                    <td>{{$pendaftaran->nik}}</td>

                    <td class="d-flex justify-content-start">
                        <div class="action-buttons">
                            <button type="button" class="btn btn-info btn-md me-1" data-bs-toggle="modal" data-bs-target="#">
                                show
                            </button>
                            <button type="button" class="btn btn-warning btn-md me-1" data-bs-toggle="modal" data-bs-target="#editdaftar">
                                Edit
                            </button>
                        {{-- <a href="/pendaftaran/{{$pendaftaran->id}}/show" class="btn btn-info btn-md me-1">Show</a> --}}
                        {{-- <a href="/pendaftaran/{{$pendaftaran->id}}/edit" class="btn btn-warning btn-md me-1">Edit</a> --}}
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


 <!-- Modal tambah -->
 <div class="modal fade" id="tambahdaftar" tabindex="-1" aria-labelledby="tambahdaftarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahdaftarLabel">Tambah Gallery</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('pendaftaran.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-6">
                  <label for="nama_lengkap" class="form-label">nama_lengkap</label>
                  <input type="text" class="form-control" name="nama_lengkap"  value="{{ old('nama_lengkap')}}">
                </div>
                <div class="col-md-6">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email"  value="{{ old('email')}}">
                </div>

                <div class="col-md-6">
                    <label for="jenis_kelamin" class="form-label">jenis kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-select">
                        <option value="" {{ old('jenis_kelamin') == '' ? 'selected' : '' }}>- Pilih jenis kelamin -</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                  <label for="nik" class="form-label">NIK</label>
                  <input type="number" class="form-control" name="nik"  value="{{ old('nik')}}">
                </div>
                <div class="col-md-6">
                  <label for="tempat_lahir" class="form-label">tempat_lahir</label>
                  <input type="text" class="form-control" name="tempat_lahir"  value="{{ old('tempat_lahir')}}">
                </div>
                <div class="col-md-6">
                    <label for="tanggal_lahir" class="form-label">tanggal_lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                </div>
                <div class="col-md-6">
                  <label for="alamat" class="form-label">alamat</label>
                  <textarea type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat">{{ old('alamat') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="tempat_tinggal" class="form-label">tempat tinggal</label>
                    <select id="tempat_tinggal" name="tempat_tinggal" class="form-select">
                        <option value="" {{ old('tempat_tinggal') == '' ? 'selected' : '' }}>- Pilih tempat tinggal -</option>
                        <option value="Bersama orang tua/wali" {{ old('tempat_tinggal') == 'Bersama orang tua/wali' ? 'selected' : '' }}>Bersama orang tua/wali</option>
                        <option value="kos" {{ old('tempat_tinggal') == 'kos' ? 'selected' : '' }}>kos</option>
                        <option value="Asrama/Pondok Pesantren" {{ old('tempat_tinggal') == 'Asrama/Pondok Pesantren' ? 'selected' : '' }}>Asrama/Pondok Pesantren</option>
                        <option value="Panti Asuhan" {{ old('tempat_tinggal') == 'Panti Asuhan' ? 'selected' : '' }}>Panti Asuhan</option>
                        <option value="lainnnya" {{ old('tempat_tinggal') == 'lainnnya' ? 'selected' : '' }}>lainnnya</option>
                    </select>
                </div>
                <div class="col-md-6">
                <label for="nama_ortu" class="form-label">nama_ortu</label>
                <input type="text" class="form-control" name="nama_ortu"  value="{{ old('nama_ortu')}}">
                </div>
                <div class="col-md-6">
                <label for="pendidikan_ortu" class="form-label">pendidikan_ortu</label>
                <input type="text" class="form-control" name="pendidikan_ortu"  value="{{ old('pendidikan_ortu')}}">
                </div>
                <div class="col-md-6">
                <label for="pekerjaan_ortu" class="form-label">pekerjaan_ortu</label>
                <input type="text" class="form-control" name="pekerjaan_ortu"  value="{{ old('pekerjaan_ortu')}}">
                </div>
                <div class="col-md-6">
                <label for="sekolah_asal" class="form-label">sekolah_asal</label>
                <input type="text" class="form-control" name="sekolah_asal"  value="{{ old('sekolah_asal')}}">
                </div>
                <div class="col-md-6">
                <label for="telepon_rumah" class="form-label">telepon_rumah</label>
                <input type="number" class="form-control" name="telepon_rumah"  value="{{ old('telepon_rumah')}}">
                </div>

                <div class="col-12">
                  <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
              </form>
      </div>
    </div>
  </div>


 <!-- Modal Edit berita -->
 <div class="modal fade" id="editdaftar" tabindex="-1" aria-labelledby="editdaftarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editdaftarLabel">Edit berita</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" method="POST" class="row g-3">
                @csrf
                @method('PATCH')
                <div class="col-md-6">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap', $pendaftaran->nama_lengkap) }}">
                </div>
        <div class="col-md-6">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="email"  value="{{ old('email', $pendaftaran->email)}}">
        </div>

        <div class="col-md-6">
            <label for="jenis_kelamin" class="form-label">jenis kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-select">
                <option value="" {{ old('jenis_kelamin',  $pendaftaran->jenis_kelamin) == '' ? 'selected' : '' }}>- Pilih jenis kelamin -</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="perempuan" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="col-md-6">
          <label for="nik" class="form-label">NIK</label>
          <input type="number" class="form-control" name="nik"  value="{{ old('nik', $pendaftaran->nik)}}">
        </div>
        <div class="col-md-6">
          <label for="tempat_lahir" class="form-label">tempat_lahir</label>
          <input type="text" class="form-control" name="tempat_lahir"  value="{{ old('tempat_lahir', $pendaftaran->tempat_lahir)}}">
        </div>
        <div class="col-md-6">
          <label for="tanggal_lahir" class="form-label">tanggal_lahir</label>
          <input type="date" class="form-control" name="tanggal_lahir"  value="{{ old('tanggal_lahir', $pendaftaran->tanggal_lahir)}}">
        </div>
        <div class="col-md-6">
          <label for="alamat" class="form-label">alamat</label>
          <textarea type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat">{{ old('alamat', $pendaftaran->alamat) }}</textarea>
        </div>
        <div class="col-md-6">
            <label for="tempat_tinggal" class="form-label">tempat tinggal</label>
            <select id="tempat_tinggal" name="tempat_tinggal" class="form-select">
                <option value="" {{ old('tempat_tinggal', $pendaftaran->tempat_tinggal) == '' ? 'selected' : '' }}>- Pilih jenis kelamin -</option>
                <option value="Bersama orang tua/wali" {{ old('tempat_tinggal', $pendaftaran->tempat_tinggal) == 'Bersama orang tua/wali' ? 'selected' : '' }}>Bersama orang tua/wali</option>
                <option value="kos" {{ old('tempat_tinggal', $pendaftaran->tempat_tinggal) == 'kos' ? 'selected' : '' }}>kos</option>
                <option value="Asrama/Pondok Pesantren" {{ old('tempat_tinggal', $pendaftaran->tempat_tinggal) == 'Asrama/Pondok Pesantren' ? 'selected' : '' }}>Asrama/Pondok Pesantren</option>
                <option value="Panti Asuhan" {{ old('tempat_tinggal', $pendaftaran->tempat_tinggal) == 'Panti Asuhan' ? 'selected' : '' }}>Panti Asuhan</option>
                <option value="lainnnya" {{ old('tempat_tinggal', $pendaftaran->tempat_tinggal) == 'lainnnya' ? 'selected' : '' }}>lainnnya</option>
            </select>
        </div>
        <div class="col-md-6">
        <label for="nama_ortu" class="form-label">nama_ortu</label>
        <input type="text" class="form-control" name="nama_ortu"  value="{{ old('nama_ortu', $pendaftaran->nama_ortu)}}">
        </div>
        <div class="col-md-6">
        <label for="pendidikan_ortu" class="form-label">pendidikan_ortu</label>
        <input type="text" class="form-control" name="pendidikan_ortu"  value="{{ old('pendidikan_ortu', $pendaftaran->pendidikan_ortu)}}">
        </div>
        <div class="col-md-6">
        <label for="pekerjaan_ortu" class="form-label">pekerjaan_ortu</label>
        <input type="text" class="form-control" name="pekerjaan_ortu"  value="{{ old('pekerjaan_ortu', $pendaftaran->pekerjaan_ortu)}}">
        </div>
        <div class="col-md-6">
        <label for="sekolah_asal" class="form-label">sekolah_asal</label>
        <input type="text" class="form-control" name="sekolah_asal"  value="{{ old('sekolah_asal', $pendaftaran->sekolah_asal)}}">
        </div>
        <div class="col-md-6">
        <label for="telepon_rumah" class="form-label">telepon_rumah</label>
        <input type="number" class="form-control" name="telepon_rumah"  value="{{ old('telepon_rumah', $pendaftaran->telepon_rumah)}}">
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</body>




@endsection
