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
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal"
                                style="width: 150px">
                                <i class="fas fa-plus me-1"></i>TAMBAH
                        </button>
                        <div class="row g-3 align-items-center mt-2">
                            <div class="col-auto">
                                <form action="{{ route('gallerie.index') }}" method="get">
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
                                    <th scope="col" class="text-center">NAMA GALLERY</th>
                                    <th scope="col" class="text-center">TANGGAL</th>
                                    <th scope="col" class="text-center">SAMPUL</th>
                                    <th scope="col" class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                                @foreach ($gallerie as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td class="text-center">{{ $item->nama_gallery }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D-MMMM-YYYY') }}</td>
                                        <td class="text-center">
                                            @if ($item->sampul)
                                                <img src="{{ asset('storage/'.$item->sampul) }}" alt="sampul" width="100px" height="70px">
                                            @else
                                                No Image
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <form action="{{ route('gallerie.destroy', ['gallerie' => $item->id]) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus ini?');">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$gallerie->links()}}
                    </div>
                </div>
            </div>

            {{-- modal tambah --}}
            <div class="modal" tabindex="-1" id="tambahModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">TAMBAH</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('gallerie.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="nama_gallery" class="form-label">NAMA GALLERY</label>
                                    <input type="text" class="form-control @error('nama_gallery') is-invalid @enderror" id="nama_gallery" name="nama_gallery" value="{{ old('nama_gallery') }}">
                                    @error('nama_gallery')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">TANGGAL</label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" min="{{ now()->toDateString() }}" max="{{ now()->toDateString() }}">
                                    @error('tanggal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="sampul" class="form-label">SAMPUL</label>
                                    <input type="file" class="form-control @error('sampul') is-invalid @enderror" id="sampul" name="sampul">

                                    @error('sampul')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    @if(old('sampul'))
                                        <p>File sebelumnya:</p>
                                        <img src="{{ asset('storage/' . old('sampul')) }}" alt="Previous Photo" width="100">
                                    @endif
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

            <!-- Modal Edit di sini -->
            @foreach ($gallerie as $item)
                <div class="modal" tabindex="-1" id="editModal{{ $item->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">EDIT</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('gallerie.update', ['gallerie' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="edit_nama_gallery" class="form-label">NAMA GALLERY</label>
                                        <input type="text" class="form-control @error('nama_gallery') is-invalid @enderror" id="edit_nama_gallery" name="nama_gallery" value="{{ old('nama_gallery', $item->nama_gallery) }}">
                                        @error('nama_gallery')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_tanggal" class="form-label">TANGGAL</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="edit_tanggal" name="tanggal" value="{{ old('tanggal', $item->tanggal) }}" min="{{ now()->toDateString() }}" max="{{ now()->toDateString() }}">
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>



                                    <div class="mb-3">
                                        <label for="edit_sampul" class="form-label">SAMPUL</label>
                                        <input type="file" class="form-control @error('sampul') is-invalid @enderror" id="edit_sampul" name="sampul" value="{{ old('sampul') }}">

                                        @if ($item->sampul)
                                            <img src="{{ asset('storage/' . $item->sampul) }}" alt="sampul" width="50" height="50">
                                        @else
                                            No Image
                                        @endif

                                        @error('sampul')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
