<?php

use app\cores\Session;
use app\cores\View;
use app\helpers\Dump;

$data = View::getData();
$user = Session::get("user");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi Mahasiswa</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Galatea', sans-serif;
            background-color: #f5f5f5;
        }

        /* Section Styles */
        .section {
            background-color: #0039C8;
            padding: 20px;
            border-radius: 15px;
            margin: 15px;
            max-width: 100%;
            word-wrap: break-word;
        }
        

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            text-align: center;
            margin-bottom: 15px;
        }

        .btn-warning {
            background-color: white;
            color: #0039C8;
            border: none;
        }

        .btn-warning:hover {
            background-color: #0039C8;
            color: white;
        }

        .btn-success {
            background-color: #AFFA08;
            color: #0039C8;
            border: none;
        }

        .btn-success:hover {
            background-color: #0039C8;
        }

        .upload-btn {
            font-family: 'Robot Crush', sans-serif;
            font-size: 40px;
            font-weight: 300;
            background-color: #0039C8;
            color: #AFFA08;
            border: none;
            padding: 20px;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            max width: 100%;
        }

        /* Container Responsif */
        .container {
            max-width: 100%;
            padding-left: 10px;
            padding-right: 10px;
        }

        /* Flexbox untuk data container */
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            /* Mengurangi gap untuk tombol lebih rapat */
        }
    </style>
</head>

<body>

    <?php if (Session::get("role") == "2"): ?>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-5 text-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="../<?= $user ?>/upload-prestasi" class="upload-btn" role="button">Upload Prestasi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

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
        <!-- Data "Belum Divalidasi" akan ditampilkan di sini -->
        <div id="belum-div" class="row">
            <?php
            $prestasi = $data;
            foreach ($prestasi as $item):
                if ($item['validasi'] == 0): // Belum Divalidasi
            ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $item['judul_kompetisi'] ?></h5>
                                <p class="card-text">Status: Belum Divalidasi</p>
                                <p class="card-text">Skor: <?= $item['skor'] ?></p>
                                <form action="../<?= $user ?>/detail-prestasi" method="POST">
                                    <input type="hidden" name="prestasi_id" value="<?= $item['id'] ?>">
                                    <button type="submit" class="btn btn-warning">Detail Prestasi</button>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php endif;
            endforeach; ?>
        </div>

        <!-- Data "Sudah Divalidasi" akan ditampilkan di sini -->
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
                                <form action="../<?= $user ?>/detail-prestasi" method="POST">
                                    <input type="hidden" name="prestasi_id" value="<?= $item['id'] ?>">
                                    <button type="submit" class="btn btn-success">Detail Prestasi</button>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php endif;
            endforeach; ?>
        </div>
    </div>

    <!-- JS and Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Script untuk Filter -->
    <script>
        $(document).ready(function() {
            // Menyembunyikan kedua bagian (belum dan sudah divalidasi) saat halaman pertama dimuat
            $("#belum-div").hide();
            $("#sudah-div").hide();

            // Saat tombol "Belum Divalidasi" ditekan
            $("#filterBelum").click(function() {
                $("#belum-div").show(); // Menampilkan data yang belum divalidasi
                $("#sudah-div").hide(); // Menyembunyikan data yang sudah divalidasi
            });

            // Saat tombol "Sudah Divalidasi" ditekan
            $("#filterSudah").click(function() {
                $("#sudah-div").show(); // Menampilkan data yang sudah divalidasi
                $("#belum-div").hide(); // Menyembunyikan data yang belum divalidasi
            });
        });
    </script>
</body>

</html>