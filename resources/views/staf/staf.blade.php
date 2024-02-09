@extends('layouts.app')

@section('content')
    @if(session('success'))
<!-- Sertakan CSS Summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<!-- Sertakan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Sertakan JS Summernote -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

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

    @php
        $userRole = auth()->user()->role;
    @endphp

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
                                <form action="{{ route('berita.index') }}" method="get">
                                    @csrf
                                    <input type="search" name="search" class="from-control">
                                    <button type="submit" class="search-button btn-secondary button-model-1">Cari</button>
                                </form>
                         </div>
                         </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped border-primary">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="text-center">NO</th>
                                    <th>JUDUL BERITA</th>
                                    <th>ISI</th>
                                    <th>KATEGORI</th>
                                    <th>TANGGAL</th>
                                    <th>FOTO</th>
                                    @if($userRole == 'admin')
                                    <th scope="col" class="text-center">AKSI</th>
                                @endif
                                </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                                @foreach ($berita as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $item->judul_berita }}</td>
                                        <td>{{ $item->isi }}</td>
                                        <td>{{ ($item->kategori) ? $item->kategori->nama : '' }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td class="text-center">
                                            @if ($item->foto)
                                                <img src="{{ asset('storage/'.$item->foto) }}" alt="Foto" width="100px" height="70px">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        @if($userRole == 'admin')
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <form action="{{ route('berita.destroy', ['berita' => $item->id]) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus ini?');">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$berita->links()}}
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
                        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="judul_berita" class="form-label">JUDUL BERITA</label>
                                <input type="text" class="form-control @error('judul_berita') is-invalid @enderror" id="judul_berita" name="judul_berita" value="{{ old('judul_berita') }}">
                                @error('judul_berita')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- <div class="mb-3">
                                <label for="isi" class="form-label">ISI</label>
                                <input type="text" class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" value="{{ old('isi') }}">
                                @error('isi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}

                            <div class="mb-3">
                                <label for="isi" class="form-label">ISI BERITA</label>
                                <textarea name="isi" id="isi">{{ old('isi') }}</textarea>
                            </div>

                            <script>
                                $(document).ready(function () {
                                    $('#isi').summernote({
                                        placeholder: 'Isi berita...',
                                        tabsize: 2,
                                        height: 300
                                    });
                                });
                            </script>


                            <div class="mb-3">
                                <label for="kategori_tambah" class="form-label">KATEGORI</label>
                                <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_tambah" name="kategori_id" aria-label="Default select example">
                                    <option value="" selected>PILIH KATEGORI</option>
                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                                            {{ $kat->nama }}
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
                                <label for="tanggal" class="form-label">TANGGAL</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" min="{{ now()->toDateString() }}" max="{{ now()->toDateString() }}">
                                @error('tanggal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="foto" class="form-label">FOTO</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" value="{{ old('foto') }}">
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
        @foreach ($berita as $item)
            <div class="modal" tabindex="-1" id="editModal{{ $item->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">EDIT</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('berita.update', ['berita' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="edit_judul_berita" class="form-label">JUDUL BERITA</label>
                                    <input type="text" class="form-control @error('judul_berita') is-invalid @enderror" id="edit_judul_berita" name="judul_berita" value="{{ old('judul_berita', $item->judul_berita) }}">
                                    @error('judul_berita')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- <div class="mb-3">
                                    <label for="edit_isi" class="form-label">ISI</label>
                                    <input type="text" class="form-control @error('isi') is-invalid @enderror" id="edit_isi" name="isi" value="{{ old('isi', $item->isi) }}">
                                    @error('isi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}

                                <div class="mb-3">
                                    <label for="edit_isi" class="form-label">ISI BERITA</label>
                                    <textarea name="isi" id="edit_isi">{{ old('isi') }}</textarea>
                                </div>


                                <div class="mb-3">
                                    <label for="edit_kategori_id" class="form-label">NAMA KATEGORI</label>
                                    <select class="form-select @error('kategori_id') is-invalid @enderror" id="edit_kategori_id" name="kategori_id" value="{{ old('kategori_id', $item->kategori_id) }}">
                                        <option value="" selected>PILIH KATEGORI</option>
                                        @foreach ($kategori as $kat)
                                            <option value="{{ $kat->id }}" {{ $item->kategori_id == $kat->id ? 'selected' : '' }}>
                                                {{ $kat->nama }}
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
                                    <label for="edit_tanggal" class="form-label">TANGGAL</label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="edit_tanggal" name="tanggal" value="{{ old('tanggal', $item->tanggal) }}" min="{{ now()->toDateString() }}" max="{{ now()->toDateString() }}">
                                    @error('tanggal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="edit_foto" class="form-label">FOTO</label>
                                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="edit_foto" name="foto">

                                    @if ($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" width="50" height="50">
                                    @else
                                        No Image
                                    @endif

                                    @error('foto')
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
