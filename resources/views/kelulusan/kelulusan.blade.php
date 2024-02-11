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
                                    <input type="search" name="search" class="form-control">
                                    <button type="submit" class="btn btn-secondary">Cari</button>
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
                                    <th scope="col" class="text-center">NILAI RATA-RATA</th>
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
                                        <td class="text-center">{{ $item->nilairatarata }}</td>
                                        <td class="text-center">
                                            @if($item->nilairatarata >= 80)
                                                Lulus
                                            @else
                                                Tidak Lulus
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'asatid')
                                                <form action="{{ route('kelulusan.destroy', ['kelulusan' => $item->id]) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus ini?');">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
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
                                    @isset($santri)
                                    @foreach ($santri as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
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
                                <textarea class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai">{{ implode(',', old('nilai', [])) }}</textarea>
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
    </div>
@endsection
