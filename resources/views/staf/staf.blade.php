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
                            TAMBAH
                        </button>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped border-primary">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="text-center">NO</th>
                                    <th scope="col" class="text-center">NIP</th>
                                    <th scope="col" class="text-center">NAMA</th>
                                    <th scope="col" class="text-center">TEMPAT TANGGAL LAHIR</th>
                                    <th scope="col" class="text-center">ALAMAT</th>
                                    <th scope="col" class="text-center">PENDIDIKAN</th>
                                    <th scope="col" class="text-center">JABATAN</th>
                                    <th scope="col" class="text-center">FOTO</th>
                                    <th scope="col" class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                                @foreach ($staf as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td class="text-center">{{ $item->nip }}</td>
                                        <td class="text-center">{{ $item->nama }}</td>
                                        <td class="text-center">{{ $item->ttl }}</td>
                                        <td class="text-center">{{ $item->alamat }}</td>
                                        <td class="text-center">{{ $item->pendidikan }}</td>
                                        <td class="text-center">{{ $item->jabatan }}</td>
                                        <td class="text-center">
                                            @if ($item->foto)
                                                <img src="{{ asset('storage/'.$item->foto) }}" alt="Foto" width="100px" height="70px">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                Edit
                                            </button>
                                            <form action="{{ route('staf.destroy', ['staf' => $item->id]) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus ini?');">
                                                    Hapus
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

            {{-- modal tambah --}}
            <div class="modal" tabindex="-1" id="tambahModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">TAMBAH</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('staf.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP</label>
                                    <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip') }}">
                                    @error('nip')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nama" class="form-label">NAMA</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama">
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="ttl" class="form-label">TEMPAT TANGGAL LAHIR</label>
                                    <input type="text" class="form-control @error('ttl') is-invalid @enderror" id="ttl" name="ttl" value="{{ old('ttl') }}">
                                    @error('ttl')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">ALAMAT</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}">
                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="pendidikan" class="form-label">PENDIDIKAN</label>
                                    <input type="text" class="form-control @error('pendidikan') is-invalid @enderror" id="pendidikan" name="pendidikan" value="{{ old('pendidikan') }}">
                                    @error('pendidikan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">JABATAN</label>
                                    <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" value="{{ old('jabatan') }}">
                                    @error('jabatan')
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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit di sini -->
            @foreach ($staf as $item)
                <div class="modal" tabindex="-1" id="editModal{{ $item->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">EDIT</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('staf.update', ['staf' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="edit_nip" class="form-label">NIP</label>
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror" id="edit_nip" name="nip" value="{{ old('nip', $item->nip) }}">
                                        @error('nip')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_nama" class="form-label">NAMA</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="edit_nama" name="nip" value="{{ old('nama', $item->nama) }}">
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_ttl" class="form-label">TEMPAT TANGGAL LAHIR</label>
                                        <input type="text" class="form-control @error('ttl') is-invalid @enderror" id="edit_ttl" name="nip" value="{{ old('ttl', $item->ttl) }}">
                                        @error('ttl')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_alamat" class="form-label">ALAMAT</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="edit_alamat" name="nip" value="{{ old('alamat', $item->alamat) }}">
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_foto" class="form-label">FOTO</label>
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="edit_foto" name="foto" value="{{ old('foto') }}">

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

                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection