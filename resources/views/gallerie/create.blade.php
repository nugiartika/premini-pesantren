@extends('layouts.app')
@section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="modal-content">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-success"><i class="fa-regular fa-image me-1"></i>TAMBAH DATA GALLERY </h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('gallerie.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row g-3">

                                    <div class="col">
                                        <label for="nama_gallery" class="form-label">NAMA GALLERY</label>
                                        <input type="text" class="form-control @error('nama_gallery') is-invalid @enderror" id="nama_gallery" name="nama_gallery" value="{{ old('nama_gallery') }}">
                                        @error('nama_gallery')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="tanggal" class="form-label">TANGGAL</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" min="{{ now()->toDateString() }}" max="{{ now()->toDateString() }}">
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>


                                <div class="row g-3">

                                    <div class="col">
                                        <label for="status" class="form-label">STATUS</label>
                                        @if(auth()->user()->role == 'admin')
                                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                                <option value="Private" {{ old('status') == 'Private' ? 'selected' : '' }}>Private</option>
                                                <option value="Public" {{ old('status') == 'Public' ? 'selected' : '' }}>Public</option>
                                            </select>
                                        @else
                                            <input type="text" class="form-control" id="status" name="status" value="Private" readonly>
                                        @endif
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="sampul" class="form-label">SAMPUL</label>
                                        <input type="file" class="form-control @error('sampul') is-invalid @enderror" id="sampul" name="sampul" value="{{ old('sampul') }}">
                                        @error('sampul')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col">
                                    <input type="hidden" class="form-control @error('user_posting') is-invalid @enderror" id="user_posting" name="user_posting" value="{{ old('user_posting', auth()->user()->role) }}" readonly>
                                    @error('user_posting')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check-circle me-1"></i>SIMPAN</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.href='{{ route('gallerie.index') }}'"><i class="fas fa-undo me-1"></i>BATAL</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection


