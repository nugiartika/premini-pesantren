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
                                    <th scope="col" class="text-center">NAMA ASATID</th>
                                    <th scope="col" class="text-center">NIP</th>
                                    <th scope="col" class="text-center">TANGGAL LAHIR</th>
                                    <th scope="col" class="text-center">ALAMAT</th>
                                    <th scope="col" class="text-center">PENDIDIKAN</th>
                                    <th scope="col" class="text-center">FOTO</th>
                                    <th scope="col" class="text-center">MAPEL</th>
                                    <th scope="col" class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                                @foreach ($asatid as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td class="text-center">{{ optional($item->asatidlist)->nama }}</td>
                                        <td class="text-center">{{ optional($item->asatidlist)->nip }}</td>
                                        <td class="text-center">{{ optional($item->asatidlist)->ttl }}</td>
                                        <td class="text-center">{{ optional($item->asatidlist)->alamat }}</td>
                                        <td class="text-center">{{ optional($item->asatidlist)->pendidikan }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . optional($item->asatidlist)->foto) }}" alt="Foto Asatid" width="100">
                                        </td>
                                        <td class="text-center">{{ optional($item->mapel)->nama }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <form action="{{ route('asatid.destroy', ['asatid' => $item->id]) }}" method="POST" style="display:inline">
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
                        {{$asatid->links()}}
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
                            <form action="{{ route('asatid.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <select class="form-select @error('asatidlist_id') is-invalid @enderror" name="asatidlist_id" aria-label="Default select example">
                                        <option value="" selected>PILIH NAMA ASATID</option>
                                        @foreach ($asatidlist as $kat)
                                            <option value="{{ $kat->id }}" {{ old('asatidlist_id') == $kat->id ? 'selected' : '' }}>
                                                {{ $kat->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('asatidlist_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <select class="form-select @error('mapel_id') is-invalid @enderror" name="mapel_id" aria-label="Default select example">
                                        <option value="" selected>PILIH MAPEL</option>
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
            @foreach ($asatid as $item)
                <div class="modal" tabindex="-1" id="editModal{{ $item->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">EDIT</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('asatid.update', ['asatid' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="edit_asatidlist_id" class="form-label">NAMA ASATID</label>
                                        <select class="form-select @error('asatidlist_id') is-invalid @enderror" id="edit_asatidlist_id" name="asatidlist_id">
                                            <option value="" {{ old('asatidlist_id', $item->asatidlist_id) ? '' : 'selected' }}>PILIH NAMA ASATID</option>
                                            @foreach ($asatidlist as $kat)
                                                <option value="{{ $kat->id }}" {{ old('asatidlist_id', $item->asatidlist_id) == $kat->id ? 'selected' : '' }}>
                                                    {{ $kat->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('asatidlist_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_mapel_id" class="form-label">MAPEL</label>
                                        <select class="form-select @error('mapel_id') is-invalid @enderror" id="edit_mapel_id" name="mapel_id">
                                            <option value=""  {{ old('mapel_id', $item->mapel_id) ? '' : 'selected' }}>PILIH MAPEL</option>
                                            @foreach ($mapel as $kat)
                                                <option value="{{ $kat->id }}" {{ old('mapel_id', $item->mapel_id) == $kat->id ? 'selected' : '' }}>
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
