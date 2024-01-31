@extends('layouts.app')

@section('content')
    @if(session('success'))
        <!-- Success Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <!-- Modal Content -->
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal" style="width: 150px">
                            TAMBAH
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">NO</th>
                                            <th class="text-center">NAMA LENGKAP</th>
                                            <th class="text-center">JENIS KELAMIN</th>
                                            <th class="text-center">NIK</th>
                                            <th class="text-center">TEMPAT & TANGGAL LAHIR</th>
                                            <th class="text-center">ALAMAT</th>
                                            <th class="text-center">NAMA ORTU</th>
                                            <th class="text-center">PENDIDIKAN ORTU</th>
                                            <th class="text-center">PEKERJAAN ORTU</th>
                                            <th class="text-center">SEKOLAH ASAL</th>
                                            <th class="text-center">TELEPON RUMAH</th>
                                            <th class="text-center">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendaftaran as $index => $data)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td class="text-center">{{ $data->nama_lengkap }}</td>
                                                <td class="text-center">{{ $data->jenis_kelamin }}</td>
                                                <td class="text-center">{{ $data->nik }}</td>
                                                <td class="text-center">{{ $data->tempat_lahir }} {{ \Carbon\Carbon::parse($data->tanggal_lahir)->isoFormat('D-MMMM-YYYY') }}</td>
                                                <td class="text-center">{{ $data->alamat }}</td>
                                                <td class="text-center">{{ $data->nama_ortu }}</td>
                                                <td class="text-center">{{ $data->pendidikan_ortu }}</td>
                                                <td class="text-center">{{ $data->pekerjaan_ortu }}</td>
                                                <td class="text-center">{{ $data->sekolah_asal }}</td>
                                                <td class="text-center">{{ $data->telepon_rumah }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-warning btn-md me-1" data-bs-toggle="modal" data-bs-target="#editdaftar{{ $data->id }} ">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('pendaftaran.destroy', ['pendaftaran' => $data->id]) }}" method="POST" style="display:inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus ini?');">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>

            <div class="modal fade"  tabindex="-1" aria-labelledby="editdaftarLabel" aria-hidden="true" id="editdaftar{{ $data->id }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editdaftarLabel">Edit Pendaftaran</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pendaftaran.update', ['pendaftaran' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap', $data->nama_lengkap) }}">
                            </div>
                    {{-- <div class="col-md-6">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" name="email"  value="{{ old('email', $data->email)}}">
                    </div> --}}

                    <div class="col-md-6">
                        <label for="jenis_kelamin" class="form-label">jenis kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select">
                            <option value="" {{ old('jenis_kelamin',  $data->jenis_kelamin) == '' ? 'selected' : '' }}>- Pilih jenis kelamin -</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="perempuan" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                      <label for="nik" class="form-label">NIK</label>
                      <input type="number" class="form-control" name="nik"  value="{{ old('nik', $data->nik)}}">
                    </div>
                    <div class="col-md-6">
                      <label for="tempat_lahir" class="form-label">tempat_lahir</label>
                      <input type="text" class="form-control" name="tempat_lahir"  value="{{ old('tempat_lahir', $data->tempat_lahir)}}">
                    </div>
                    <div class="col-md-6">
                      <label for="tanggal_lahir" class="form-label">tanggal_lahir</label>
                      <input type="date" class="form-control" name="tanggal_lahir"  value="{{ old('tanggal_lahir', $data->tanggal_lahir)}}">
                    </div>
                    <div class="col-md-6">
                      <label for="alamat" class="form-label">alamat</label>
                      <textarea type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat">{{ old('alamat', $data->alamat) }}</textarea>
                    </div>
                    {{-- <div class="col-md-6">
                        <label for="tempat_tinggal" class="form-label">tempat tinggal</label>
                        <select id="tempat_tinggal" name="tempat_tinggal" class="form-select">
                            <option value="" {{ old('tempat_tinggal', $data->tempat_tinggal) == '' ? 'selected' : '' }}>- Pilih jenis kelamin -</option>
                            <option value="Bersama orang tua/wali" {{ old('tempat_tinggal', $data->tempat_tinggal) == 'Bersama orang tua/wali' ? 'selected' : '' }}>Bersama orang tua/wali</option>
                            <option value="kos" {{ old('tempat_tinggal', $data->tempat_tinggal) == 'kos' ? 'selected' : '' }}>kos</option>
                            <option value="Asrama/Pondok Pesantren" {{ old('tempat_tinggal', $data->tempat_tinggal) == 'Asrama/Pondok Pesantren' ? 'selected' : '' }}>Asrama/Pondok Pesantren</option>
                            <option value="Panti Asuhan" {{ old('tempat_tinggal', $data->tempat_tinggal) == 'Panti Asuhan' ? 'selected' : '' }}>Panti Asuhan</option>
                            <option value="lainnnya" {{ old('tempat_tinggal', $data->tempat_tinggal) == 'lainnnya' ? 'selected' : '' }}>lainnnya</option>
                        </select>
                    </div> --}}
                    <div class="col-md-6">
                    <label for="nama_ortu" class="form-label">nama_ortu</label>
                    <input type="text" class="form-control" name="nama_ortu"  value="{{ old('nama_ortu', $data->nama_ortu)}}">
                    </div>
                    <div class="col-md-6">
                    <label for="pendidikan_ortu" class="form-label">pendidikan_ortu</label>
                    <input type="text" class="form-control" name="pendidikan_ortu"  value="{{ old('pendidikan_ortu', $data->pendidikan_ortu)}}">
                    </div>
                    <div class="col-md-6">
                    <label for="pekerjaan_ortu" class="form-label">pekerjaan_ortu</label>
                    <input type="text" class="form-control" name="pekerjaan_ortu"  value="{{ old('pekerjaan_ortu', $data->pekerjaan_ortu)}}">
                    </div>
                    <div class="col-md-6">
                    <label for="sekolah_asal" class="form-label">sekolah_asal</label>
                    <input type="text" class="form-control" name="sekolah_asal"  value="{{ old('sekolah_asal', $data->sekolah_asal)}}">
                    </div>
                    <div class="col-md-6">
                    <label for="telepon_rumah" class="form-label">telepon_rumah</label>
                    <input type="number" class="form-control" name="telepon_rumah"  value="{{ old('telepon_rumah', $data->telepon_rumah)}}">
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            @endforeach
        </table>
    </div>

 <!-- Modal tambah -->
 <div class="modal" tabindex="-1" id="tambahModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">TAMBAH</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">NAMA LENGKAP</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                        @error('nama_lengkap')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="jenis_kelamin" class="form-label">JENIS KELAMIN</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                            <option value="">- Pilih jenis kelamin -</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" required>
                        @error('nik')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">TEMPAT LAHIR</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                        @error('tempat_lahir')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">TANGGAL LAHIR</label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" max="{{ now()->toDateString() }}" required>
                        @error('tanggal_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <small class="text-danger">
                                @if ($errors->has('tanggal_lahir'))
                                    {{ $errors->first('tanggal_lahir') }}
                                @endif
                            </small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">ALAMAT</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                        @error('alamat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_ortu" class="form-label">NAMA ORTU</label>
                        <input type="text" class="form-control" id="nama_ortu" name="nama_ortu" required>
                        @error('nama_ortu')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pendidikan_ortu" class="form-label">PENDIDIKAN ORTU</label>
                        <input type="text" class="form-control" id="pendidikan_ortu" name="pendidikan_ortu" required>
                        @error('pendidikan_ortu')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pekerjaan_ortu" class="form-label">PEKERJAAN ORTU</label>
                        <input type="text" class="form-control" id="pekerjaan_ortu" name="pekerjaan_ortu" required>
                        @error('pekerjaan_ortu')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sekolah_asal" class="form-label">SEKOLAH ASAL</label>
                        <input type="text" class="form-control" id="sekolah_asal" name="sekolah_asal" required>
                        @error('sekolah_asal')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="telepon_rumah" class="form-label">TELEPON RUMAH</label>
                        <input type="text" class="form-control" id="telepon_rumah" name="telepon_rumah" required>
                        @error('telepon_rumah')
                            <span class="text-danger">{{ $message }}</span>
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


 {{-- <!-- Modal Edit berita -->
 @foreach ($pendaftaran as $data)
 <div class="modal" tabindex="-1" id="editModal{{ $data->id }}">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">EDIT</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form action="{{ route('pendaftaran.update', ['pendaftaran' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     @method('PUT')

                     <div class="mb-3">
                        <label for="edit_nama_lengkap" class="form-label">NAMA LENGKAP</label>
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="edit_nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $data->nama_lengkap) }}">
                        @error('nama_lengkap')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="edit_jenis_kelamin" class="form-label">JENIS KELAMIN</label>
                        <select id="edit_jenis_kelamin" name="jenis_kelamin" class="form-select">
                            <option value="" {{ old('jenis_kelamin', $pendaftaran->first()->jenis_kelamin) == '' ? '' : 'selected' }}>- Pilih jenis kelamin -</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $pendaftaran->first()->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $pendaftaran->first()->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>

                    </div>

                     <div class="mb-3">
                        <label for="edit_nik" class="form-label">NIK</label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="edit_nik" name="nik" value="{{ old('nik', $data->nik) }}">
                        @error('nik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                     <div class="mb-3">
                        <label for="edit_tempat_lahir" class="form-label">TEMPAT LAHIR</label>
                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="edit_tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $data->tempat_lahir) }}">
                        @error('tempat_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_tanggal_lahir" class="form-label">TANGGAL LAHIR</label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="edit_tanggal_lahir" name="tanggal_lahir" max="{{ now()->toDateString() }}" value="{{ old('tanggal_lahir', $data->tanggal_lahir) }}">
                        @error('tanggal_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                     <div class="mb-3">
                        <label for="edit_alamat" class="form-label">ALAMAT</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="edit_alamat" name="alamat" value="{{ old('alamat', $data->alamat) }}">
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                     <div class="mb-3">
                        <label for="edit_nama_ortu" class="form-label">NAMA ORTU</label>
                        <input type="text" class="form-control @error('nama_ortu') is-invalid @enderror" id="edit_nama_ortu" name="nama_ortu" value="{{ old('nama_ortu', $data->nama_ortu) }}">
                        @error('nama_ortu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                     <div class="mb-3">
                        <label for="edit_pendidikan_ortu" class="form-label">PENDIDIKAN ORTU</label>
                        <input type="text" class="form-control @error('pendidikan_ortu') is-invalid @enderror" id="edit_pendidikan_ortu" name="pendidikan_ortu" value="{{ old('pendidikan_ortu', $data->pendidikan_ortu) }}">
                        @error('pendidikan_ortu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                     <div class="mb-3">
                        <label for="edit_pekerjaan_ortu" class="form-label">PEKERJAAN ORTU</label>
                        <input type="text" class="form-control @error('pekerjaan_ortu') is-invalid @enderror" id="edit_pekerjaan_ortu" name="pekerjaan_ortu" value="{{ old('pekerjaan_ortu', $data->pekerjaan_ortu) }}">
                        @error('pekerjaan_ortu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                     <div class="mb-3">
                        <label for="edit_sekolah_asal" class="form-label">SEKOLAH ASAL </label>
                        <input type="text" class="form-control @error('sekolah_asal') is-invalid @enderror" id="edit_sekolah_asal" name="sekolah_asal" value="{{ old('sekolah_asal', $data->sekolah_asal) }}">
                        @error('sekolah_asal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                     <div class="mb-3">
                        <label for="edit_telepon_rumah" class="form-label">TELEPON RUMAH</label>
                        <input type="text" class="form-control @error('telepon_rumah') is-invalid @enderror" id="edit_telepon_rumah" name="telepon_rumah" value="{{ old('telepon_rumah', $data->telepon_rumah) }}">
                        @error('telepon_rumah')
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
             @endforeach --}}
         </div>
     </div>
 @endsection





