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
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$pendaftaran->links()}}
                    </div>
                </div>
            </div>

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
