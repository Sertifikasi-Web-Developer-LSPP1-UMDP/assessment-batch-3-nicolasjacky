<!-- Form Edit Informasi -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Form Edit Informasi</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('update-informasi', $informasi->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $informasi->judul }}" required>
                </div>
                <div class="form-group">
                    <label for="isi">Isi</label>
                    <textarea class="form-control" id="isi" name="isi" required>{{ $informasi->isi }}</textarea>
                </div>
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
