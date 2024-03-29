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
                        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'asatid')
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal" style="width: 150px">
                            <i class="fas fa-plus me-1"></i>TAMBAH
                        </button>
                        @endif
                        <div class="row g-3 align-items-center mt-2">
                            <div class="col-auto">
                                <form action="{{ route('kelulusan.index') }}" method="get">
                                    @csrf
                                    <input type="search" name="search" class="from-control">
                                    <button type="submit" class="search-button btn-secondary button-model-1">Cari</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-dark table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="text-center">NO</th>
                                    <th scope="col" class="text-center">NISN</th>
                                    <th scope="col" class="text-center">NAMA SANTRI</th>
                                    <th scope="col" class="text-center">NO UJIAN</th>
                                    <th scope="col" class="text-center">KELAS</th>
                                    <th scope="col" class="text-center">MAPEL</th>
                                    <th scope="col" class="text-center">NILAI</th>
                                    <th scope="col" class="text-center">KETERANGAN</th>
                                    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'asatid')
                                    <th scope="col" class="text-center">AKSI</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                                @foreach ($kelulusan as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td class="text-center">{{ optional($item->santri)->nisn }}</td>
                                        <td class="text-center">{{ optional($item->santri)->nama }}</td>
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
                                        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'asatid')
                                        <td class="text-center">
                                                <form action="{{ route('kelulusan.destroy', ['kelulusan' => $item->id]) }}" method="POST" style="display:inline">
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>

                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus ini?');">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$kelulusan->links()}}
                    </div>
                </div>
            </div>
        </div>

         <!-- Modal Tambah -->
         <div class="modal" tabindex="-1" id="tambahModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-bell me-1"></i>TAMBAH DATA KELULUSAN </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kelulusan.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="santri_id" class="form-label">SANTRI</label>
                                <select class="form-select" id="santri_id" name="santri_id">
                                    <option value="" {{ old('santri_id') == '' ? 'selected' : '' }}>PILIH SANTRI</option>
                                    <option value="" {{ old('santri_id') == '' ? 'selected' : '' }}>PILIH SANTRI</option>
                                    @isset($santri)
                                        @foreach ($santri as $kat)
                                            @if ($kat->klssantri_id !== null)
                                                <option value="{{ $kat->id }}" {{ old('santri_id') == $kat->id ? 'selected' : '' }}>
                                                    {{ $kat->nama }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endisset
                                </select>
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
                                <label for="mapel_id" class="form-label">MAPEL</label>
                                <select class="form-select @error('mapel_id') is-invalid @enderror" name="mapel_id" aria-label="Default select example">
                                    <option value="" {{ old('mapel_id') == '' ? 'selected' : '' }}>PILIH MAPEL</option>
                                    @foreach ($mapel as $kat)
                                        <option value="{{ $kat->id }}" {{ old('mapel_id') == $kat->id ? 'selected' : '' }}>
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
                                <label for="nilai" class="form-label">NILAI</label>
                                <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" value="{{ old('nilai') }}">
                                @error('nilai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-undo me-1"></i>BATAL</button>
                                <button type="submit" class="btn btn-success"><i class="fas fa-check-circle me-1"></i>SIMPAN</button>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

                    <!-- Modal Edit di sini -->
                    @foreach ($kelulusan as $item)
                    <div class="modal" tabindex="-1" id="editModal{{ $item->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-newspaper me-1"></i>EDIT DATA KELULUSAN</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('kelulusan.update', ['kelulusan' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="edit_santri_id" class="form-label">NAMA SANTRI</label>
                                            <select class="form-select @error('santri_id') is-invalid @enderror" id="edit_santri_id" name="santri_id">
                                                <option value="" {{ old('santri_id', $item->santri_id) ? '' : 'selected' }} selected>PILIH NAMA SANTRI</option>
                                                @foreach ($santri as $kat)
                                                @if ($kat->klssantri_id !== null)
                                                @if ($kat->klssantri_id !== null)
                                                    <option value="{{ $kat->id }}" {{ old('santri_id', $item->santri_id) == $kat->id ? 'selected' : '' }}>
                                                        {{ $kat->nama }}
                                                    </option>
                                                    @endif
                                                    @endif
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
                                                <option value="" {{old('mapel_id',  $item->mapel_id) ? '' : 'selected' }}>PILIH MAPEL</option>
                                                @foreach ($mapel as $kat)
                                                    <option value="{{ $kat->id }}" {{old('mapel_id', $item->mapel_id)  == $kat->id ? 'selected' : '' }}>
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
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-undo me-1"></i>BATAL</button>
                                        <button type="submit" class="btn btn-success"><i class="fas fa-check-circle me-1"></i>SIMPAN</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
    </div>
@endsection
