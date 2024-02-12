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
                                    {{-- <th scope="col" class="text-center">NO UJIAN</th> --}}
                                    <th scope="col" class="text-center">KELAS</th>
                                    {{-- <th scope="col" class="text-center">MAPEL</th>
                                    <th scope="col" class="text-center">NILAI</th>
                                    <th scope="col" class="text-center">KETERANGAN</th> --}}
                                    <th scope="col" class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                                @foreach ($kelulusan as $index => $item)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td class="text-center">{{ $item->nisn }}</td>
                                    <td class="text-center">{{ $item->nama }}</td>
                                    {{-- <td class="text-center">{{ $item->no_ujian }}</td> --}}
                                    <td class="text-center">{{ $item->klssantri->nama_kelas }}</td>
                                    {{-- <td class="text-center">{{ $item->nilai }}</td> --}}
                                        {{-- <td class="text-center">
                                            @if($item->nilai >= 80)
                                                Lulus
                                            @else
                                                Tidak Lulus
                                            @endif
                                        </td> --}}
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
                        {{-- {{$kelulusan->links()}} --}}
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
                                    <label for="no_ujian" class="form-label">NO UJIAN</label>
                                    <input type="text" class="form-control @error('no_ujian') is-invalid @enderror" id="no_ujian" name="no_ujian" value="{{ $item->no_ujian }}">
                                    @error('no_ujian')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    @foreach ($mapel as $m)
                                        <label for="nilai_{{ $m->id }}" class="form-label">{{ $m->nama }}</label>
                                        <input type="number" class="form-control" id="nilai_{{ $m->id }}" name="nilai[{{ $m->id }}]" value="{{ $item->nilai[$m->id] ?? '' }}">
                                    @endforeach
                                </div>



                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @endsection
