<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Halaman Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <!-- Header -->
        <div class="container py-5">
            <h1 class="text-center">Halaman Admin</h1>
        </div>

        <!-- Tabel User Mahasiswa -->
        <div class="container py-5">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Tabel User Mahasiswa</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status Verifikasi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            @if($user->role == 'mahasiswa')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->verified)
                                        <span class="badge badge-success text-success fs-6">Verified</span>
                                    @else
                                        <span class="badge badge-danger text-danger fs-6">Not Verified</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$user->verified)
                                    <form action="{{ route('verifikasi', $user->id) }}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success">Verifikasi</button>
                                    </form>
                                    @else
                                        <form action="{{ route('batalkan-verifikasi', $user->id) }}" method="post" style="display: inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-danger">Batalkan Verifikasi</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tabel Formulir -->
        <div class="container py-5">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Tabel Formulir</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>User ID</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Agama</th>
                                <th>Status Pendaftaran</th>
                                <th></th>
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
                                        <span class="badge badge-warning text-warning fs-6">Pending</span>
                                    @elseif ($formulir->status_pendaftaran == 'diterima')
                                        <span class="badge badge-success text-success fs-6">Diterima</span>
                                    @else
                                        <span class="badge badge-danger text-danger fs-6">Ditolak</span>
                                    @endif
                                </td>
                                <td>
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
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Form Informasi -->
        <div class="container py-5">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Form Informasi</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('simpan-informasi') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul">
                        </div>
                        <div class="form-group">
                            <label for="isi">Isi</label>
                            <textarea class="form-control" id="isi" name="isi"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel Informasi -->
        <div class="container py-5">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Tabel Informasi</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($informasis as $informasi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $informasi->judul }}</td>
                                <td>{{ $informasi->isi }}</td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('edit-informasi', $informasi->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('hapus-informasi', $informasi->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
