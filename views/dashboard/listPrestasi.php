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

        .big-banner {
            height: 40vh;
            background: linear-gradient(270deg, #0039C8 0%, #001C62 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
            position: relative;
            padding: 20px;
        }

        .leaderboard-title {
            font-size: 6vw;
            font-family: 'Robot Crush', sans-serif;
            font-style: italic;
            font-weight: 400;
            color: #AFFA08;
            max-width: 100%;
            word-wrap: break-word;
        }

        .banner-caption {
            font-size: 4vw;
            font-family: 'Galatea', sans-serif;
            font-weight: 700;
            color: white;
            max-width: 100%;
            word-wrap: break-word;
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
            background-color: #AFFA08;
            color: #0039C8;
            border: none;
        }

        .btn-warning:hover {
            background-color: white;
            color: #0039C8;
        }

        .btn-success {
            background-color: #AFFA08;
            color: #0039C8;
            border: none;
        }

        .btn-success:hover {
            background-color: white;
            color: #0039C8;
        }

        /* Gaya khusus untuk form section dengan ukuran lebih pendek */
        .section-short {
            padding: 10px;
            margin: 10px;
        }

        .section-short .section-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        /* Upload Form Section */
        .upload-form-container {
            background-color: #0039C8;
            padding: 30px;
            border-radius: 15px;
            margin: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .upload-btn {
            font-family: 'Robot Crush', sans-serif;
            font-size: 30px;
            font-weight: 300;
            background-color: #0039C8;
            color: #AFFA08;
            border: none;
            padding: 30px;
            border-radius: 15px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            width: 100%;
        }

        .upload-btn:hover {
            background-color: #001C62;
            color: #fff;
        }

        .container {
            max-width: 100%;
            padding-left: 10px;
            padding-right: 10px;
        }


        /* Flexbox for data container */
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        /* Responsivitas untuk kolom data */
        .card {
            overflow: hidden;
            word-wrap: break-word;
            max-height: 100%;
            flex-grow: 1;
        }

        .card-title {
            font-size: 1.1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-text {
            font-size: 0.9rem;
        }

        /* Pengaturan margin dan padding */
        .container {
            max-width: 100%;
            padding: 15px;
        }
    </style>
</head>

<body>

    <!-- Big Banner -->
    <div class="big-banner">
        <h2 class="leaderboard-title">PRESTASI MAHASISWA</h2>
        <p class="banner-caption">Data Kompetisi Mahasiswa</p>
    </div>

    <?php if (Session::get("role") == "2"): ?>
        <div class="container mt-4">
            <a href="../<?= $user ?>/upload-prestasi" class="upload-btn" role="button">Upload Prestasi</a>
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
        <div id="belum-div" class="row">
            <?php
            $prestasi = $data;
            if (empty($prestasi)): // Cek apakah data kosong
            ?>
                <div class="col-12">
                    <p class="text-center text-danger">Maaf, data kosong.</p>
                </div>
                <?php
            else:
                foreach ($prestasi as $item):
                    if ($item['validasi'] == 0): // Belum Divalidasi
                ?>
                        <div class="col-12 col-sm-6 col-md-4 mb-4" style="flex: 1 1 calc(33.333% - 10px); max-width: calc(33.333% - 10px);">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate"><?= $item['judul_kompetisi'] ?></h5>
                                    <p class="card-text">Status: Belum Divalidasi</p>
                                    <p class="card-text">Skor: <?= $item['skor'] ?></p>
                                    <form action="../<?= $user ?>/detail-prestasi" method="POST">
                                        <input type="hidden" name="prestasi_id" value="<?= $item['id'] ?>">
                                        <button type="submit" class="btn btn-warning w-100">Detail Prestasi</button>
                                    </form>
                                </div>
                            </div>
                        </div>
            <?php endif;
                endforeach;
            endif;
            ?>
        </div>

        <!-- Data "Sudah Divalidasi" akan ditampilkan di sini -->
        <div id="sudah-div" class="row">
            <?php
            if (empty($prestasi)): // Cek apakah data kosong
            ?>
                <div class="col-12">
                    <p class="text-center text-danger">Maaf, data kosong.</p>
                </div>
                <?php
            else:
                foreach ($prestasi as $item):
                    if ($item['validasi'] == 1): // Sudah Divalidasi
                ?>
                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate"><?= $item['judul_kompetisi'] ?></h5>
                                    <p class="card-text">Status: Sudah Divalidasi</p>
                                    <p class="card-text">Divalidasi oleh Admin: <?= $item['admin_nama'] ?></p>
                                    <p class="card-text">Skor: <?= $item['skor'] ?></p>
                                    <form action="../<?= $user ?>/detail-prestasi" method="POST">
                                        <input type="hidden" name="prestasi_id" value="<?= $item['id'] ?>">
                                        <button type="submit" class="btn btn-success w-100">Detail Prestasi</button>
                                    </form>
                                </div>
                            </div>
                        </div>
            <?php endif;
                endforeach;
            endif;
            ?>
        </div>
    </div>


    <!-- JS and Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Script untuk Filter -->
    <script>
        $(document).ready(function() {
            $("#belum-div").hide();
            $("#sudah-div").hide();

            $("#filterBelum").click(function() {
                $("#belum-div").show();
                $("#sudah-div").hide();
            });

            $("#filterSudah").click(function() {
                $("#sudah-div").show();
                $("#belum-div").hide();
            });
        });
    </script>

</body>

</html>