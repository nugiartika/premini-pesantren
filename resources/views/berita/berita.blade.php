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
        <h1>berita</h1>

        <button type="button" class="btn btn-primary btn-md mb-3" data-bs-toggle="modal" data-bs-target="#tambahberita">
            + tambah
        </button>

        {{-- <a href="{{ route('berita.create') }}" class="btn btn-primary btn-md mb-3">Daftar</a> --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>judul berita</th>
                    <th>slug</th>
                    <th>kategori</th>
                    <th>tanggal</th>
                    <th>user posting</th>
                    <th>sampul</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            @foreach ($beritas as $key => $berita)
            <tbody>
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$berita->judul_berita}}</td>
                    <td>{{$berita->slug}}</td>
                    <td>{{($berita->kategori)->nama}}</td>
                    <td>{{$berita->tanggal}}</td>
                    <td>{{$berita->user_posting}}</td>
                    <td>
                        @if ($berita->sampul)
                            <img src="{{ asset('storage/'.$berita->sampul) }}" alt="" width="100px" height="70px">
                        @else
                            No Image
                        @endif
                    </td>
                    {{-- <td><img src="{{ asset('storage/images/'.$berita->sampul) }}" width="80px" height="70px"></td> --}}
                    <td class="d-flex justify-content-start">
                        <div class="action-buttons">
                            <button type="button" class="btn btn-primary btn-md me-1" data-bs-toggle="modal" data-bs-target="#editberita" data-id="{{ $berita->id }}">
                                Edit
                            </button>
                        <form action="/berita/{{$berita->id}}" method="post">
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




  <!-- Modal tambah berita -->
  <div class="modal fade" id="tambahberita" tabindex="-1" aria-labelledby="tambahberitaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahberitaLabel">Tambah berita</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="judul_berita" class="form-label">judul berita</label>
                    <input type="text" class="form-control" name="judul_berita"  value="{{ old('judul_berita')}}">
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">slug</label>
                    <input type="text" class="form-control" name="slug"  value="{{ old('slug')}}">
                </div>
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select @error('kategori_id') is-invalid @enderror" name="kategori_id" aria-label="Default select example">
                        <option value="" {{ old('kategori_id') == '' ? 'selected' : '' }}>- Pilih kategori -</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">tanggal</label>
                    <input type="date" class="form-control" name="tanggal"  value="{{ old('tanggal')}}">
                </div>
                <div class="mb-3">
                    <label for="user_posting" class="form-label">user_posting</label>
                    <input type="text" class="form-control" name="user_posting"  value="{{ old('user_posting')}}">
                </div>
                <div class="mb-3">
                    <label for="sampul" class="form-label">sampul</label>
                    <input type="file" class="form-control" name="sampul"  value="{{ old('sampul')}}">
                    @error('sampul')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>




  <!-- Modal Edit berita -->
  <div class="modal fade" id="editberita" tabindex="-1" aria-labelledby="editberitaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editberitaLabel">Edit berita</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="judul_berita" class="form-label">judul_berita</label>
                    <input type="text" class="form-control" name="judul_berita"  value="{{ old('judul_berita', $berita->judul_berita)}}">
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">slug</label>
                    <input type="text" class="form-control" name="slug"  value="{{ old('slug', $berita->slug)}}">
                </div>
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select @error('kategori_id') is-invalid @enderror" name="kategori_id" aria-label="Default select example">
                        <option value="" {{ old('kategori_id', $berita->kategori_id) ? '' : 'selected' }}>- Pilih kategori -</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id', $berita->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">tanggal</label>
                    <input type="date" class="form-control" name="tanggal"  value="{{ old('tanggal', $berita->tanggal)}}">
                </div>
                <div class="mb-3">
                    <label for="user_posting" class="form-label">user_posting</label>
                    <input type="text" class="form-control" name="user_posting"  value="{{ old('user_posting', $berita->user_posting)}}">
                </div>
                <div class="mb-3">
                    <label for="sampul" class="form-label">sampul</label>
                    <input type="file" class="form-control @error('sampul') is-invalid @enderror" name="sampul" accept="image/*">
                    @error('sampul')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
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
