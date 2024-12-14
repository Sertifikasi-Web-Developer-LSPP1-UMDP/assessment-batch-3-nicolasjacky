@extends('admin')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="container py-5">
        <h3 class="card-title mb-4">Tabel Informasi</h3>

        <!-- Pesan Sukses atau Kesalahan -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Form untuk menambah informasi -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Tambah Informasi</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('simpan-informasi') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="isi">Isi</label>
                        <textarea name="isi" id="isi" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Informasi</button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">Daftar Informasi</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Foto</th> <!-- Kolom untuk foto -->
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($informasis as $informasi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $informasi->judul }}</td>
                            <td>{{ $informasi->isi }}</td>
                            <td>
                                @if($informasi->foto)
                                    <img src="{{ asset('uploads/' . $informasi->foto) }}" alt="Foto" style="width: 100px; height: auto;">
                                @else
                                    <span>Tidak ada foto</span>
                                @endif
                            </td>
                            <td>{{ $informasi->created_at->format('d-m-Y') }}</td>
                            <td>
                                <form action="{{ route('edit-informasi', $informasi->id) }}" method="get" style="display: inline-block">
                                    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                </form>
                                <form action="{{ route('hapus-informasi', $informasi->id) }}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
