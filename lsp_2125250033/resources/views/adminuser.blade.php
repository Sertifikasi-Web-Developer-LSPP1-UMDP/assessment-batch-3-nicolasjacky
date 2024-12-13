@extends('admin')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="container py-5">
        <h3 class="card-title mb-4">Tabel User Mahasiswa</h3>

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
                            <th>Email</th>
                            <th>Status Verifikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->verified)
                                    <span class="badge bg-success text-white fs-7">Diverifikasi</span>
                                @else
                                    <span class="badge bg-warning text-dark fs-7">Belum Diverifikasi</span>
                                @endif
                            </td>
                            <td>
                                @if(!$user->verified)
                                    <form action="{{ route('verifikasi', $user->id) }}" method="post" style="display: inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Verifikasi</button>
                                    </form>
                                @else
                                    <form action="{{ route('batalkan-verifikasi', $user->id) }}" method="post" style="display: inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Batalkan Verifikasi</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
