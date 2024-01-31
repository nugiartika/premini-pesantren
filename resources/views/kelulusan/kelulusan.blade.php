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
        <script src="{{ asset('js/app.js') }}"></script>
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
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal" style="width: 150px">
                            <i class="fas fa-plus me-1"></i>TAMBAH
                        </button>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped border-primary">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="text-center">NO</th>
                                    <th scope="col" class="text-center">NIS</th>
                                    <th scope="col" class="text-center">NAMA SANTRI</th>
                                    <th scope="col" class="text-center">NO UJIAN</th>
                                    <th scope="col" class="text-center">KELAS</th>
                                    <th scope="col" class="text-center">MAPEL</th>
                                    <th scope="col" class="text-center">NILAI</th>
                                    <th scope="col" class="text-center">KETERANGAN</th>
                                    <th scope="col" class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                                @foreach ($kelulusan as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td class="text-center">{{ optional($item->santri)->nis }}</td>
                                        <td class="text-center">{{ optional($item->santri->pendaftaran)->nama_lengkap }}</td>
                                        <td class="text-center">{{ $item->no_ujian }}</td>
                                        <td class="text-center">{{ optional($item->santri->klssantri)->nama_kelas }}</td>
                                        <td class="text-center">{{ optional($item->mapel)->nama }}</td>
                                        <td class="text-center">{{ $item->nilai }}</td>
                                        <td class="text-center">
                                            @if($item->nilai >= 80)
                                                Lulus
                                            @else
                                                Tidak Lulus
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                <i class="fas fa-pen-to-square"></i>
                                            </button>
                                            <form action="{{ route('kelulusan.destroy', ['kelulusan' => $item->id]) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus ini?');">
                                                    <i class="fas fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tambah -->
        <div class="modal" tabindex="-1" id="tambahModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">TAMBAH</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kelulusan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <select class="form-select @error('santri_id') is-invalid @enderror" name="santri_id" aria-label="Default select example">
                                    <option value="" selected>PILIH NAMA</option>
                                    @foreach ($santri as $kat)
                                        <option value="{{ $kat->id }}" {{ old('santri_id') == $kat->id ? 'selected' : '' }}>
                                            {{ $kat->pendaftaran->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('santri_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="no_ujian" class="form-label">NO UJIAN</label>
                                <input type="text" class="form-control @error('no_ujian') is-invalid @enderror" id="no_ujian" name="no_ujian" value="{{ old('no_ujian') }}">
                                @error('no_ujian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="mapel" class="form-label">MAPEL</label>
                                <select class="form-select @error('mapel_id') is-invalid @enderror" name="mapel_id" aria-label="Default select example">
                                    <option value="" selected>PILIH MAPEL</option>
                                    @foreach ($mapel as $kat)
                                        <option value="{{ $kat->id }}" {{ old('mapel_id') == $kat->id ? 'selected' : '' }}>
                                            {{ $kat->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                                <div class="mb-3">
                                    <label for="nilai" class="form-label">NILAI</label>
                                    <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" value="{{ old('nilai') }}">
                                    @error('nilai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        @foreach ($kelulusan as $item)
            <div class="modal" tabindex="-1" id="editModal{{ $item->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">EDIT</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('kelulusan.update', ['kelulusan' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">

                                    <div class="mb-3">
                                        <label for="edit_santri_id" class="form-label">NAMA SANTRI</label>
                                        <select class="form-select @error('santri_id') is-invalid @enderror" id="edit_santri_id" name="santri_id" value="{{ old('santri_id', $item->santri_id) }}">
                                            <option value="" selected>PILIH NAMA SANTRI</option>
                                            @foreach ($santri as $kat)
                                                <option value="{{ $kat->id }}" {{ $item->santri_id == $kat->id ? 'selected' : '' }}>
                                                    {{ $kat->pendaftaran->nama_lengkap }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('santri_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_no_ujian" class="form-label">NO UJIAN</label>
                                        <input type="text" class="form-control @error('no_ujian') is-invalid @enderror" id="edit_no_ujian" name="no_ujian" value="{{ old('no_ujian', $item->no_ujian) }}">
                                        @error('no_ujian')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_mapel_id" class="form-label">MAPEL</label>
                                        <select class="form-select @error('mapel_id') is-invalid @enderror" id="edit_mapel_id" name="mapel_id">
                                            <option value="" selected>PILIH MAPEL</option>
                                            @foreach ($mapel as $kat)
                                                <option value="{{ $kat->id }}" {{ $item->mapel_id == $kat->id ? 'selected' : '' }}>
                                                    {{ $kat->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('mapel_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_nilai" class="form-label">NILAI</label>
                                        <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="edit_nilai" name="nilai" value="{{ old('nilai', $item->nilai) }}">
                                        @error('nilai')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
