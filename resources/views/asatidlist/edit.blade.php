
@extends('layouts.app')

@section('content')
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">EDIT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('asatidlist.update', ['asatidlist' => $asatidlist->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="edit_nip" class="form-label">NIP</label>
                        <input type="text" class="form-control @error('nip') is-invalid @enderror" id="edit_nip" name="nip" value="{{ old('nip', $asatidlist->nip) }}">
                        @error('nip')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">NAMA</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="edit_nama" name="nama" value="{{ old('nama', $asatidlist->nama) }}">
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_email" class="form-label">EMAIL</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="edit_email" name="email" value="{{ old('email', $asatidlist->email) }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_tempat_lahir" class="form-label">TEMPAT LAHIR</label>
                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="edit_tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $asatidlist->tempat_lahir) }}">
                        @error('tempat_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_ttl" class="form-label">TANGGAL LAHIR</label>
                        <input type="date" class="form-control @error('ttl') is-invalid @enderror" id="edit_ttl" name="ttl" max="{{ now()->toDateString() }}" value="{{ old('ttl', $asatidlist->ttl) }}">
                        @error('ttl')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">ALAMAT</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="edit_alamat" name="alamat" value="{{ old('alamat', $asatidlist->alamat) }}">
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="edit_pendidikan" class="form-label">PENDIDIKAN</label>
                        <input type="text" class="form-control @error('pendidikan') is-invalid @enderror" id="edit_pendidikan" name="pendidikan" value="{{ old('pendidikan', $asatidlist->pendidikan) }}">
                        @error('pendidikan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_foto" class="form-label">FOTO</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="edit_foto" name="foto" value="{{ old('foto') }}">

                        @if ($asatidlist->foto)
                            <img src="{{ asset('storage/' . $asatidlist->foto) }}" alt="Foto" width="50" height="50">
                        @else
                            No Image
                        @endif

                        @error('foto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.href='{{ route('asatidlist.index') }}'">BATAL</button>
                <button type="submit" class="btn btn-primary">SIMPAN</button>
            </div>
        </div>
    </div>

@endsection



