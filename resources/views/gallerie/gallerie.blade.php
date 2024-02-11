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
                        <a href="{{ route('gallerie.create') }}" class="btn btn-success" style="width: 150px">
                            <i class="fas fa-plus me-1"></i>TAMBAH
                        </a>
                        <div class="row g-3 align-items-center mt-2">
                            <div class="col-auto">
                                <form action="{{ route('gallerie.index') }}" method="get">
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
                                    <th scope="col" class="text-center">NAMA GALLERY</th>
                                    <th scope="col" class="text-center">TANGGAL</th>
                                    <th scope="col" class="text-center">USER POSTING</th>
                                    <th scope="col" class="text-center">SAMPUL</th>
                                    <th scope="col" class="text-center">STATUS</th>
                                    <th scope="col" class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                                @foreach ($gallerie as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td class="text-center">{{ $item->nama_gallery }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D-MMMM-YYYY') }}</td>
                                        <td class="text-center">{{ $item->user_posting }}</td>
                                        <td class="text-center">
                                            @if ($item->sampul)
                                                <img src="{{ asset('storage/'.$item->sampul) }}" alt="sampul" width="100px" height="70px">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $item->status }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning" onclick="window.location='{{ route('gallerie.edit', ['gallerie' => $item->id]) }}'">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <form action="{{ route('gallerie.destroy', ['gallerie' => $item->id]) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus ini?');">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $gallerie->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
