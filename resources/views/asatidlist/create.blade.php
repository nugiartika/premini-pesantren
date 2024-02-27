@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="modal-content">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-success"><i class="fa-solid fa-users me-1"></i>TAMBAH DATA ASATID </h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('asatidlist.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                            <div class="row g-3">
                                <div class="col">
                                    <label for="nip" class="form-label">NIP</label>
                                    <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip') }}">
                                    @error('nip')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="nama" class="form-label">NAMA</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row g-3">
                                <div class="col">
                                <label for="email" class="form-label">EMAIL</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>

                                <div class="col">
                                    <label for="pendidikan" class="form-label">PENDIDIKAN</label>
                                    <input type="text" class="form-control @error('pendidikan') is-invalid @enderror" id="pendidikan" name="pendidikan" value="{{ old('pendidikan') }}">
                                    @error('pendidikan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="row g-3">
                                <div class="col">
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

                                <div class="col">
                                    <label for="alamat" class="form-label">ALAMAT</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}">
                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3">

                                <div class="col">
                                    <label for="tempat_lahir" class="form-label">TEMPAT LAHIR</label>
                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                                    @error('tempat_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="foto" class="form-label">FOTO</label>
                                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">

                                    @php
                                        $oldFoto = old('foto');
                                    @endphp

                                    @if($oldFoto)
                                        <img src="{{ asset('storage/' . $oldFoto) }}" alt="Old Foto" style="max-width: 100px; max-height: 100px;">
                                    @endif

                                    @error('foto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.href='{{ route('asatidlist.index') }}'"><i class="fas fa-undo me-1"></i>BATAL</button>
                            <button type="submit" class="btn btn-success"><i class="fas fa-check-circle me-1"></i>SIMPAN</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection


