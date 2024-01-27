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
        <h1>kelas</h1>

        <button type="button" class="btn btn-primary btn-md mb-3" data-bs-toggle="modal" data-bs-target="#tambahkelas">
            + tambah
        </button>

        {{-- <a href="{{ route('kelas.create') }}" class="btn btn-primary btn-md mb-3">Daftar</a> --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>nama kelas</th>
                    <th>wali kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            @foreach ($kelas as $key => $kelas)
            <tbody>
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$kelas->nama_kelas}}</td>
                    <td>{{$kelas->wali_kelas}}</td>

                    <td class="d-flex justify-content-start">
                        <div class="action-buttons">
                            <button type="button" class="btn btn-primary btn-md me-1" data-bs-toggle="modal" data-bs-target="#editkelas" data-id="{{ $kelas->id }}">
                                Edit
                            </button>
                            <form action="/kelas/{{$kelas->id}}" method="post">
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




  <!-- Modal tambah kelas -->
  <div class="modal fade" id="tambahkelas" tabindex="-1" aria-labelledby="tambahkelasLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahkelasLabel">Tambah kelas</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_kelas" class="form-label">nama_kelas</label>
                    <input type="text" class="form-control" name="nama_kelas"  value="{{ old('nama_kelas')}}">
                </div>
                <div class="mb-3">
                    <label for="wali_kelas" class="form-label">wali kelas</label>
                    <input type="text" class="form-control" name="wali_kelas"  value="{{ old('wali_kelas')}}">
                </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>




  <!-- Modal Edit kelas -->
 {{--  @foreach ($kelas as $item)
  <div class="modal fade" id="editkelas" tabindex="-1" aria-labelledby="editkelasLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editkelasLabel">Edit kelas</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('kelas.update', ['kelas' => $item->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_kelas" class="form-label">nama_kelas</label>
                    <input type="text" class="form-control" name="nama_kelas"  value="{{ old('nama_kelas', $item->nama_kelas)}}">
                </div>
                <div class="mb-3">
                    <label for="wali_kelas" class="form-label">wali_kelas</label>
                    <input type="text" class="form-control" name="wali_kelas"  value="{{ old('wali_kelas', $item->wali_kelas)}}">
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</body>


@endsection
