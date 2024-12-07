<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lomba Baru</title>
    <link rel="stylesheet" href="/assets/css/styles.css"> <!-- Sesuaikan dengan file CSS Anda -->
</head>
<body>
    <div class="container">
        <h1>Tambah Lomba Baru</h1>
        <form action="/infoLomba/store" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul Lomba</label>
                <input type="text" id="judul" name="judul" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Lomba</label>
                <textarea id="deskripsi" name="deskripsi_lomba" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Akhir Pendaftaran</label>
                <input type="date" id="tanggal" name="tanggal_akhir_pendaftaran" required>
            </div>
            <div class="form-group">
                <label for="link">Link Pendaftaran</label>
                <input type="url" id="link" name="link_perlombaan" required>
            </div>
            <div class="form-group">
                <label for="poster">File Poster</label>
                <input type="file" id="poster" name="file_poster" accept="image/*" required>
            </div>
            <div class="form-group">
                <button type="submit">Simpan</button>
                <a href="/infoLomba" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
