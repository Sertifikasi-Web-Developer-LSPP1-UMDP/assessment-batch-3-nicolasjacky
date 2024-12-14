<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/user') ? 'active' : '' }}" href="{{ route('admin.user') }}">User  Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/formulir') ? 'active' : '' }}" href="{{ route('admin.formulir') }}">Formulir</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/informasi') ? 'active' : '' }}" href="{{ route('admin.informasi') }}">Informasi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h1 class="text-center mb-4">Halaman @if (Auth::user()->role == 'admin') Admin @else Dashboard @endif</h1>
        <div class="card text-center shadow-sm">
            <div class="card-header bg-info text-white fs-6">
                Selamat Datang di Panel Admin!
            </div>
        </div>
    </div>

    <!-- Tampilkan konten berdasarkan view yang dipilih -->
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
