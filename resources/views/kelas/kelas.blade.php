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


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
        {{-- <h1>kelas</h1> --}}

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahkelas"
        style="width: 150px">
                    + tambah
        </button>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped border-primary">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="text-center">NO</th>
                        <th scope="col" class="text-center">NAMA KELAS</th>
                        <th scope="col" class="text-center">WALI KELAS</th>
                        <th scope="col" class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-center">
                @foreach ($kelas as $key => $data)
                <tr>
                    <td>{{++$key}}</td>
                    <td class="text-center">{{$data->nama_kelas}}</td>
                    <td class="text-center">{{$data->wali_kelas}}</td>

                    <td class="d-flex justify-content-start">
                        <div class="action-buttons">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $data->id }}">
                                Edit
                            </button>
                            <form action="{{ route('kelas.destroy', ['kela' => $data->id]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-md" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>

            <div class="modal" tabindex="-1" id="editModal{{ $data->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">EDIT</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('kelas.update', ['kela' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="edit_nama" class="form-label">NAMA KELAS</label>
                                    <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" id="edit_nama" name="nama_kelas" value="{{ old('nama_kelas', $data->nama_kelas) }}">
                                    @error('nama_kelas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="edit_wali_kelas" class="form-label">TEMPAT TANGGAL LAHIR</label>
                                    <input type="text" class="form-control @error('wali_kelas') is-invalid @enderror" id="edit_wali_kelas" name="wali_kelas" value="{{ old('wali_kelas', $data->wali_kelas) }}">
                                    @error('wali_kelas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div></form>
                    </div>
                </div>
            </div>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>




  <!-- Modal Edit kelas -->
  {{-- @foreach ($kelas as $data)
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Edit kelas</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('kelas.update', ['kela' => $data->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_kelas" class="form-label">nama_kelas</label>
                    <input type="text" class="form-control" name="nama_kelas"  value="{{ old('nama_kelas', $data->nama_kelas)}}">
                </div>
                <div class="mb-3">
                    <label for="wali_kelas" class="form-label">wali_kelas</label>
                    <input type="text" class="form-control" name="wali_kelas"  value="{{ old('wali_kelas', $data->wali_kelas)}}">
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


@endsection
