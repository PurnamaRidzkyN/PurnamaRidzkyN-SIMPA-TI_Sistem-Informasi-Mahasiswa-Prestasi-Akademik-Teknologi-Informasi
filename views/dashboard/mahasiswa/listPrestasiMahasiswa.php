<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi Mahasiswa</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add your styles here (same as in your example) */
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <img src="logoHijau.png" alt="Logo">
            <h1>SIMPA-TI</h1>
        </div>
        <div class="menu">
            <a href="#home">Home</a>
            <a href="#prestasi">Prestasi</a>
            <a href="#leaderboard">Leaderboard</a>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="section">
        <div class="section-title">Status Validasi</div>
        <div class="row justify-content-center">
            <div class="col-md-5 text-center">
                <button class="btn btn-warning w-100" id="filterBelum">Belum Divalidasi</button>
            </div>
            <div class="col-md-5 text-center">
                <button class="btn btn-success w-100" id="filterSudah">Sudah Divalidasi</button>
            </div>
        </div>
    </div>

    <!-- Data Container -->
    <div class="container">
        <div id="belum-div" class="row">
            <?php
            // Looping through "prestasi" items
            foreach ($prestasi as $item):
                if ($item['validasi'] == 0): // Belum Divalidasi
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item['judul_kompetisi'] ?></h5>
                            <p class="card-text">Status: Belum Divalidasi</p>
                            <p class="card-text">Skor: <?= $item['skor'] ?></p>
                            <form action="/dashboard/<?= $user ?>/detail-prestasi" method="POST">
                                <input type="hidden" name="prestasi_id" value="<?= $item['id'] ?>">
                                <button type="submit" class="btn btn-warning">Detail Prestasi</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; endforeach; ?>
        </div>

        <div id="sudah-div" class="row">
            <?php
            // Looping through "prestasi" items
            foreach ($prestasi as $item):
                if ($item['validasi'] == 1): // Sudah Divalidasi
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item['judul_kompetisi'] ?></h5>
                            <p class="card-text">Status: Sudah Divalidasi</p>
                            <p class="card-text">Divalidasi oleh Admin: <?= $item['admin_nama'] ?></p>
                            <p class="card-text">Skor: <?= $item['skor'] ?></p>
                            <form action="/dashboard/<?= $user ?>/detail-prestasi" method="POST">
                                <input type="hidden" name="prestasi_id" value="<?= $item['id'] ?>">
                                <button type="submit" class="btn btn-success">Detail Prestasi</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; endforeach; ?>
        </div>
    </div>

    <!-- JS and Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // JS to toggle between the filtered sections
        $("#filterBelum").click(function() {
            $("#belum-div").show();
            $("#sudah-div").hide();
        });

        $("#filterSudah").click(function() {
            $("#belum-div").hide();
            $("#sudah-div").show();
        });
    </script>
</body>
</html>
