
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
        $userRole = auth()->user()->role ?? null;
        @endphp

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('berita.create') }}" class="btn btn-success" style="width: 150px">
                                <i class="fas fa-plus me-1"></i>TAMBAH
                            </a>
                            <div class="row g-3 align-items-center mt-2">
                                <div class="col-auto">
                                    <form action="{{ route('berita.index') }}" method="get">
                                        @csrf
                                        <input type="search" name="search" class="from-control">
                                        <button type="submit" class="search-button btn-secondary button-model-1">Cari</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-dark table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="text-center">NO</th>
                                        <th>JUDUL BERITA</th>
                                        <th>ISI</th>
                                        <th>KATEGORI</th>
                                        <th>TANGGAL</th>
                                        @if($userRole == 'admin')
                                            <th scope="col" class="text-center">AKSI</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider text-center">
                                    @foreach ($berita as $index => $item)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $item->judul_berita }}</td>
                                            <td>{!! $item->isi !!}</td>
                                            <td>{{ optional($item->kategori)->nama }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            @if($userRole == 'admin')
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-warning" onclick="window.location='{{ route('berita.edit', ['berita' => $item->id]) }}'">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <form action="{{ route('berita.destroy', ['berita' => $item->id]) }}" method="POST" style="display:inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus ini?');">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $berita->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
