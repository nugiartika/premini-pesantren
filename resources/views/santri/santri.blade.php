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
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped border-primary">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="text-center">NO</th>
                                    <th scope="col" class="text-center">NIS</th>
                                    <th scope="col" class="text-center">NAMA</th>
                                    <th scope="col" class="text-center">KELAS</th>
                                    <th scope="col" class="text-center">ALAMAT</th>
                                    <th scope="col" class="text-center">TANGGAL LAHIR</th>
                                    <th scope="col" class="text-center">JENIS KELAMIN</th>
                                    <th scope="col" class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                                @foreach ($santri as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td class="text-center">{{ $item->nis }}</td>
                                        <td class="text-center">{{ $item->nama }}</td>
                                        <td class="text-center">{{ optional($item->klssantri)->nama_kelas }}</td>
                                        <td class="text-center">{{ $item->alamat }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->ttl)->isoFormat('D-MMMM-YYYY') }}</td>
                                        <td class="text-center">{{ $item->jns_kelamin }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <form action="{{ route('santri.destroy', ['santri' => $item->id]) }}" method="POST" style="display:inline">
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
                            <form action="{{ route('santri.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="nis" class="form-label">NIS</label>
                                    <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ old('nis') }}">
                                    @error('nis')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nama" class="form-label">NAMA</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <select class="form-select @error('klssantri_id') is-invalid @enderror" name="klssantri_id" aria-label="Default select example">
                                        <option value="" selected>PILIH KELAS</option>
                                        @foreach ($klssantri as $kat)
                                            <option value="{{ $kat->id }}" {{ old('klssantri_id') == $kat->id ? 'selected' : '' }}>
                                                {{ $kat->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('klssantri_id')
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
                                    <label for="ttl" class="form-label">TANGGAL LAHIR</label>
                                    <input type="date" class="form-control @error('ttl') is-invalid @enderror" id="ttl" name="ttl" value="{{ old('ttl') }}" max="{{ now()->toDateString() }}" required>
                                    @error('ttl')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        <small class="text-danger">
                                            @if ($errors->has('ttl'))
                                                {{ $errors->first('ttl') }}
                                            @endif
                                        </small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jns_kelamin" class="form-label">JENIS KELAMIN</label>
                                    <select class="form-select @error('jns_kelamin') is-invalid @enderror" name="jns_kelamin" aria-label="Default select example">
                                        <option value="" selected>PILIH JENIS KELAMIN</option>
                                        <option value="Laki-Laki" {{ old('jns_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="Perempuan" {{ old('jns_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jns_kelamin')
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
            @foreach ($santri as $item)
                <div class="modal" tabindex="-1" id="editModal{{ $item->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">EDIT</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('santri.update', ['santri' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="edit_nis" class="form-label">NIS</label>
                                        <input type="text" class="form-control @error('nis') is-invalid @enderror" id="edit_nis" name="nis" value="{{ old('nis', $item->nis) }}">
                                        @error('nis')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_nama" class="form-label">NAMA</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="edit_nama" name="nama" value="{{ old('nama', $item->nama) }}">
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_klssantri_id" class="form-label">KELAS</label>
                                        <select class="form-select @error('klssantri_id') is-invalid @enderror" id="edit_klssantri_id" name="klssantri_id" value="{{ old('klssantri_id', $item->klssantri_id) }}">
                                            <option value="" selected>PILIH KELAS</option>
                                            @foreach ($klssantri as $kat)
                                                <option value="{{ $kat->id }}" {{ $item->klssantri_id == $kat->id ? 'selected' : '' }}>
                                                    {{ $kat->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('klssantri_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_alamat" class="form-label">ALAMAT</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="edit_alamat" name="alamat" value="{{ old('alamat', $item->alamat) }}">
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_ttl" class="form-label">TANGGAL LAHIR</label>
                                        <input type="date" class="form-control @error('ttl') is-invalid @enderror" id="edit_ttl" name="ttl" max="{{ now()->toDateString() }}" value="{{ old('ttl', $item->ttl) }}">
                                        @error('ttl')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_jns_kelamin" class="form-label">JENIS KELAMIN</label>
                                        <select class="form-select @error('jns_kelamin') is-invalid @enderror" id="edit_jns_kelamin" name="jns_kelamin">
                                            <option value="" selected>PILIH JENIS KELAMIN</option>
                                            <option value="Laki-Laki" {{ old('jns_kelamin', $item->jns_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                            <option value="Perempuan" {{ old('jns_kelamin', $item->jns_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jns_kelamin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
