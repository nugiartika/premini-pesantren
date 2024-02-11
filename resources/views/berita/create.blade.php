@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="modal-content">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-newspaper me-1"></i>TAMBAH DATA BERITA</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row g-3">
                                    <div class="col">
                                        <label for="judul_berita" class="form-label">JUDUL BERITA</label>
                                    <input type="text" class="form-control @error('judul_berita') is-invalid @enderror" id="judul_berita" name="judul_berita" value="{{ old('judul_berita') }}">
                                    @error('judul_berita')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="col">
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
                                </div>

                                <div class="row g-3">
                                    <div class="col">
                                        <label for="tanggal" class="form-label">TANGGAL</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" min="{{ now()->toDateString() }}" max="{{ now()->toDateString() }}">
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="foto" class="form-label">FOTO</label>
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" value="{{ old('foto') }}">
                                        @error('foto')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col custom-content">
                                    <label for="isi" class="form-label">ISI BERITA</label>
                                    <textarea name="isi" id="summernote" class="custom-summernote" aria-label="With textarea">{{ old('isi') }}</textarea>
                                  </div>

                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.href='{{ route('berita.index') }}'"><i class="fas fa-undo me-1"></i>BATAL</button>
                            <button type="submit" class="btn btn-success"><i class="fas fa-check-circle me-1"></i>SIMPAN</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')

<script>
 $(document).ready(function() {
        $('#summernote').summernote({
          placeholder: 'Hello stand alone ui',
          tabsize: 2,
          height: 120,
          toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
          ]
        });
      });</script>
@endsection








