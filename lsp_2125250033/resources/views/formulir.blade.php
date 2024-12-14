<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Daftar Mahasiswa Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        @if(isset($status_pendaftaran))
            @if($status_pendaftaran == 'diterima')
                <div class="alert alert-success text-center">
                    <h4>Status Pendaftaran : </h4>
                    <h5><span class="text-success">Selamat! Anda Diterima Masuk Universitas</span></h5>
                </div>
            @elseif($status_pendaftaran == 'pending')
                <div class="alert alert-warning text-center">
                    <h4>Status Pendaftaran : </h4>
                    <h5><span class="text-warning">Pendaftaran Masih Diproses, Silahkan Tunggu!</span></h5>
                </div>
            @else
                <div class="alert alert-danger text-center">
                    <h4>Status Pendaftaran : </h4>
                    <h5><span class="text-danger">Mohon Maaf, Anda Ditolak</span></h5>
                </div>
            @endif
        @else
            <div class="alert alert-info text-center">
                <h4>Status Pendaftaran : </h4>
                <h5><span class="text-info">Anda Belum Melakukan Pendaftaran. Silakan Isi Form Di Bawah Ini！</span></h5>
            </div>
        @endif

        <h2 class="text-center mt-5">Informasi Terbaru</h2>
        <div class="row d-flex justify-content-center">
            @foreach($informasi as $info)
                <div class="col-md-8 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $info->judul }}</h5>
                            <p class="card-text text-center">{{ $info->isi }}</p>
                            @if($info->foto)
                                <img src="{{ asset('uploads/' . $info->foto) }}" alt="Foto" class="img-fluid mx-auto d-block" style="max-width: 100%; height: auto;">
                            @else
                                <span class="text-center d-block">Tidak ada foto</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(!isset($status_pendaftaran)) <!-- Form hanya muncul jika status_pendaftaran tidak ada -->
            <h1 class="text-center mt-5">Form Pendaftaran Mahasiswa Baru</h1>
            <form action="/daftar-formulir" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                </div>
                <div class="mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <select class="form-control" id="agama" name="agama" required>
                        <option value="Islam">Islam</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Konghucu">Konghucu</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Daftar</button>
            </form>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
