<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Semua Data Lomba</title>
    <link rel="stylesheet" href="/assets/css/styles.css"> <!-- Sesuaikan dengan file CSS Anda -->
</head>
<body>
    <div class="container">
        <h1>Hapus Semua Data Lomba</h1>
        <p>Apakah Anda yakin ingin menghapus semua data lomba? Tindakan ini tidak dapat dibatalkan.</p>
        <form action="/infoLomba/destroyAll" method="POST">
            <div class="form-group">
                <button type="submit" class="btn btn-danger">Ya, Hapus Semua</button>
                <a href="/infoLomba" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
