
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="modal-content">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-newspaper me-1"></i>TAMBAH DATA ASATID</h6>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <div class="col">
                            <label for="edit_judul_berita" class="form-label">JUDUL BERITA</label>
                            <input type="text" class="form-control @error('judul_berita') is-invalid @enderror"
                                id="edit_judul_berita" name="judul_berita"
                                value="{{ old('judul_berita', $berita->judul_berita) }}">
                            @error('judul_berita')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="edit_kategori_id" class="form-label">KATEGORI</label>
                            <select class="form-select @error('kategori_id') is-invalid @enderror"
                                id="edit_kategori_id" name="kategori_id">
                                <option value="" selected>PILIH KATEGORI</option>
                                @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}"
                                    {{ $berita->kategori_id == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama }}
                                </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col">
                            <label for="edit_tanggal" class="form-label">TANGGAL</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="edit_tanggal" name="tanggal" value="{{ old('tanggal', $berita->tanggal) }}" min="{{ now()->toDateString() }}" max="{{ now()->toDateString() }}">
                            @error('tanggal')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col custom-content">
                        <label for="isi" class="form-label">ISI BERITA</label>
                        <textarea name="isi" id="summernote" class="custom-summernote" aria-label="With textarea">{{ old('isi') }}</textarea>
                    </div>

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
                placeholder: 'Hello stand-alone UI',
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

            // Set Summernote content with the correct value
            var oldIsiValue = {!! json_encode($berita->isi) !!}; // Use the actual value from the model
            $('#summernote').summernote('code', oldIsiValue);
        });
    </script>
@endsection





