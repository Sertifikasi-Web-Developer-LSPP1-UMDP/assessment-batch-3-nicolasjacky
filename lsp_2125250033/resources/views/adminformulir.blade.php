@extends('admin')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="container py-5">
        <h3 class="card-title mb-4">Tabel Formulir</h3>

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

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>User ID</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Agama</th>
                            <th>Status Pendaftaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($formulirs as $formulir)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $formulir->nama_lengkap }}</td>
                            <td>{{ $formulir->user_id }}</td>
                            <td>{{ $formulir->jenis_kelamin }}</td>
                            <td>{{ $formulir->tempat_lahir }}</td>
                            <td>{{ $formulir->tanggal_lahir }}</td>
                            <td>{{ $formulir->agama }}</td>
                            <td>
                                @if($formulir->status_pendaftaran == 'pending')
                                    <span class="badge bg-warning text-dark fs-7">Pending</span>
                                @elseif ($formulir->status_pendaftaran == 'diterima')
                                    <span class="badge bg-success text-white fs-7">Diterima</span>
                                @else
                                    <span class="badge bg-danger text-white fs-7">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                @if($formulir->status_pendaftaran == 'pending')
                                    <form action="/daftar/{{ $formulir->id }}/terima" method="post" style="display: inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Diterima</button>
                                    </form>
                                    <form action="/daftar/{{ $formulir->id }}/tolak" method="post" style="display: inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Ditolak</button>
                                    </form>
                                @elseif($formulir->status_pendaftaran == 'diterima')
                                    <form action="/daftar/{{ $formulir->id }}/tolak" method="post" style="display: inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Ditolak</button>
                                    </form>
                                    <form action="/daftar/{{ $formulir->id }}/pending" method="post" style="display: inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning">Pending</button>
                                    </form>
                                @elseif($formulir->status_pendaftaran == 'ditolak')
                                    <form action="/daftar/{{ $formulir->id }}/terima" method="post" style="display: inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Diterima</button>
                                    </form>
                                    <form action="/daftar/{{ $formulir->id }}/pending" method="post" style="display: inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning">Pending</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
