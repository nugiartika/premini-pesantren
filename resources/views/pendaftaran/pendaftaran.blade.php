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

    @php
        $userRole = auth()->user()->role;
    @endphp

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{-- @if($userRole == 'santri')
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal"
                                style="width: 150px">
                                <i class="fas fa-plus me-1"></i>TAMBAH
                        </button>
                        @endif --}}
                    </div>

                    <div class="card-body">
                        <table class="table table-dark table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="text-center">NO</th>
                                    <th scope="col" class="text-center">NAMA</th>
                                    <th scope="col" class="text-center">EMAIL</th>
                                    <th scope="col" class="text-center">PASSWORD</th>
                                    <th scope="col" class="text-center">JENIS KELAMIN</th>
                                    <th scope="col" class="text-center">TELEPON</th>
                                    <th scope="col" class="text-center">NISN</th>
                                    <th scope="col" class="text-center">TEMPAT & TANGGAL LAHIR</th>
                                    <th scope="col" class="text-center">ALAMAT</th>
                                    <th scope="col" class="text-center">STATUS</th>
                                    @if($userRole == 'admin')
                                    <th scope="col" class="text-center">AKSI</th>
                                @endif
                                </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                                @foreach ($pendaftaran as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td class="text-center">{{ $item->nama }}</td>
                                        <td class="text-center">{{ $item->email }}</td>
                                        <td class="text-center">{{ $item->password }}</td>
                                        <td class="text-center">{{ $item->jenis_kelamin }}</td>
                                        <td class="text-center">{{ $item->telepon }}</td>
                                        <td class="text-center">{{ $item->nisn }}</td>
                                        <td class="text-center">{{ $item->tempat_lahir }} {{ \Carbon\Carbon::parse($item->tanggal_lahir)->isoFormat('D-MMMM-YYYY') }}</td>
                                        <td class="text-center">{{ $item->alamat }}</td>
                                        <td class="text-center">{{ $item->status }}</td>
                                        @if($userRole == 'admin')
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            {{-- <form action="{{ route('pendaftaran.destroy', ['pendaftaran' => $item->id]) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus ini?');">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form> --}}
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- modal tambah
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
                        <label for="sekolah_asal" class="form-label">SEKOLAH ASAL</label>
                        <input type="text" class="form-control" id="sekolah_asal" name="sekolah_asal" required>
                        @error('sekolah_asal')
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
                        <label for="telepon_rumah" class="form-label">TELEPON RUMAH</label>
                        <input type="text" class="form-control" id="telepon_rumah" name="telepon_rumah" required>
                        @error('telepon_rumah')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">STATUS</label>
                        @if($userRole == 'admin')
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" readonly>
                                <option value="daftar" {{ old('status') == 'daftar' ? 'selected' : '' }}>Daftar</option>
                                <option value="diterima" {{ old('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            </select>
                        @else
                            <input type="text" class="form-control" id="status" name="status" value="Daftar" readonly>
                        @endif
                        @error('status')
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
            </div> --}}

            <!-- Modal Edit di sini -->
            @foreach ($pendaftaran as $item)
                <div class="modal" tabindex="-1" id="editModal{{ $item->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">EDIT</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('pendaftaran.update', ['pendaftaran' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    {{-- <div class="mb-3">
                                        <label for="edit_nama_lengkap" class="form-label">NAMA LENGKAP</label>
                                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="edit_nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $item->nama_lengkap) }}">
                                        @error('nama_lengkap')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_nik" class="form-label">NIK</label>
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="edit_nik" name="nik" value="{{ old('nik', $item->nik) }}">
                                        @error('nik')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="jenis_kelamin" class="form-label">JENIS KELAMIN</label>
                                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                                            <option value="">- Pilih jenis kelamin -</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin', $item->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin', $item->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="mb-3">
                                        <label for="edit_tempat_lahir" class="form-label">TEMPAT LAHIR</label>
                                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="edit_tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $item->tempat_lahir) }}">
                                        @error('tempat_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_tanggal_lahir" class="form-label">TANGGAL LAHIR</label>
                                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="edit_tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $item->tanggal_lahir) }}">
                                        @error('tanggal_lahir')
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
                                        <label for="edit_nama_sekolah" class="form-label">SEKOLAH ASAL</label>
                                        <input type="text" class="form-control @error('sekolah_asal') is-invalid @enderror" id="edit_nama_sekolah" name="sekolah_asal" value="{{ old('sekolah_asal', $item->sekolah_asal) }}">
                                        @error('sekolah_asal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_nama_ortu" class="form-label">NAMA ORTU</label>
                                        <input type="text" class="form-control @error('nama_ortu') is-invalid @enderror" id="edit_nama_ortu" name="nama_ortu" value="{{ old('nama_ortu', $item->nama_ortu) }}">
                                        @error('nama_ortu')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_telepon_rumah" class="form-label">TELEPON RUMAH</label>
                                        <input type="text" class="form-control @error('telepon_rumah') is-invalid @enderror" id="edit_telepon_rumah" name="telepon_rumah" value="{{ old('telepon_rumah', $item->telepon_rumah) }}">
                                        @error('telepon_rumah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}

                                    <div class="mb-3">
                                        <label for="edit_status" class="form-label">STATUS</label>
                                        <select class="form-select @error('status') is-invalid @enderror" id="edit_status" name="status">
                                            @if($item->status === 'Diterima')
                                                <option value="Diterima" selected>Diterima</option>
                                                <option value="Ditolak">Ditolak</option>
                                            @else
                                                <option value="menunggu konfirmasi" {{ old('status', $item->status) == 'menunggu konfirmasi' ? 'selected' : '' }}>Menunggu konfirmasi</option>
                                                <option value="Diterima" {{ old('status', $item->status) == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                                <option value="Ditolak" {{ old('status', $item->status) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            @endif
                                        </select>
                                        @error('status')
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
