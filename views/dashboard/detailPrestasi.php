<?php

use app\cores\Session;
use app\cores\View;
use app\helpers\Dump;

$data = View::getData();
$user = Session::get("user");
$dosen = $data["dosen"];
$prestasi = $data["prestasi"];
// Periksa apakah array mengandung 'success'
$hasSuccess = in_array('benernjir', $data);

?>


<!-- Main Content -->
<div class="container mt-5">
    <div class="form-container">
        <h3>Detail Prestasi Mahasiswa</h3>

        <!-- Alert Placeholder -->
        <div id="alert-placeholder"></div>

        <form id="prestasiForm" class="needs-validation" novalidate>

            <!-- Jenis Kompetisi -->
            <div class="mb-3">
                <label for="jenis-kompetisi" class="form-label">Jenis Kompetisi</label>
                <input type="text" class="form-control" id="jenis-kompetisi" value="<?php echo $prestasi['jenis_lomba']; ?>" readonly>
            </div>

            <!-- Tingkat Kompetisi -->
            <div class="mb-3">
                <label for="tingkat-kompetisi" class="form-label">Tingkat Kompetisi</label>
                <input type="text" class="form-control" id="tingkat-kompetisi" value="<?php echo $prestasi['tingkat_lomba']; ?>" readonly>
            </div>

            <!-- Judul Kompetisi -->
            <div class="mb-3">
                <label for="judul-kompetisi" class="form-label">Judul Kompetisi</label>
                <input type="text" class="form-control" id="judul-kompetisi" value="<?php echo $prestasi['judul_kompetisi']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="judul-kompetisi-en" class="form-label">Judul Kompetisi EN</label>
                <input type="text" class="form-control" id="judul-kompetisi-en" value="<?php echo $prestasi['judul_kompetisi_en']; ?>" readonly>
            </div>

            <!-- Kategori Kompetisi -->
            <div class="mb-3">
                <label for="kategori-kompetisi" class="form-label">Kategori Kompetisi</label>
                <input type="text" class="form-control" id="kategori-kompetisi" value="<?php echo ucfirst($jenis = $prestasi['tim'] == 0 ? 'Individu' : 'Tim'); ?>" readonly>
            </div>

            <!-- Peringkat -->
            <div class="mb-3">
                <label for="peringkat" class="form-label">Peringkat</label>
                <input type="text" class="form-control" id="peringkat" value="<?php echo $prestasi['peringkat']; ?>" readonly>
            </div>

            <!-- Tempat Kompetisi -->
            <div class="mb-3">
                <label for="tempat-kompetisi" class="form-label">Tempat Kompetisi</label>
                <input type="text" class="form-control" id="tempat-kompetisi" value="<?php echo $prestasi['tempat_kompetisi']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="tempat-kompetisi" class="form-label">Tempat Kompetisi En</label>
                <input type="text" class="form-control" id="tempat-kompetisi" value="<?php echo $prestasi['tempat_kompetisi_en']; ?>" readonly>
            </div>


            <!-- URL Kompetisi -->
            <div class="mb-3">
                <label for="url-kompetisi" class="form-label">URL Kompetisi</label>
                <input type="url" class="form-control" id="url-kompetisi" value="<?php echo $prestasi['url_kompetisi']; ?>" readonly>
            </div>

            <!-- Tanggal Mulai -->
            <div class="mb-3">
                <label for="tanggal-mulai" class="form-label">Tanggal Mulai</label>
                <input type="text" class="form-control" id="tanggal-mulai" value="<?php echo date('Y/m/d', strtotime($prestasi['tanggal_mulai'])); ?>" readonly>
            </div>

            <!-- Tanggal Akhir -->
            <div class="mb-3">
                <label for="tanggal-akhir" class="form-label">Tanggal Akhir</label>
                <input type="text" class="form-control" id="tanggal-akhir" value="<?php echo date('Y/m/d', strtotime($prestasi['tanggal_akhir'])); ?>" readonly>
            </div>

            <!-- Jumlah PT -->
            <div class="mb-3">
                <label for="jumlah-pt" class="form-label">Jumlah PT</label>
                <input type="text" class="form-control" id="jumlah-pt" value="<?php echo $prestasi['jumlah_pt']; ?>" readonly>
            </div>

            <!-- Jumlah Peserta -->
            <div class="mb-3">
                <label for="jumlah-peserta" class="form-label">Jumlah Peserta</label>
                <input type="text" class="form-control" id="jumlah-peserta" value="<?php echo $prestasi['jumlah_peserta']; ?>" readonly>
            </div>

            <!-- No Surat Tugas -->
            <div class="mb-3">
                <label for="no-surat-tugas" class="form-label">No Surat Tugas</label>
                <input type="text" class="form-control" id="no-surat-tugas" value="<?php echo $prestasi['no_surat_tugas']; ?>" readonly>
            </div>

            <!-- Tanggal Surat Tugas -->
            <div class="mb-3">
                <label for="tanggal-surat-tugas" class="form-label">Tanggal Surat Tugas</label>
                <input type="text" class="form-control" id="tanggal-surat-tugas" value="<?php echo date('Y/m/d', strtotime($prestasi['tanggal_surat_tugas'])); ?>" readonly>
            </div>

            <!-- Kategori Partisipasi -->
            <div class="mb-3">
                <label for="kategori-partisipasi" class="form-label">Skor</label>
                <input type="text" class="form-control" id="kategori-partisipasi" value="<?php echo $prestasi['skor']; ?>" readonly>
            </div>

            <!-- Dosen Pembimbing (Dynamic) -->
            <div id="dosen-container" class="mb-3">
                <label for="dosen-pembimbing" class="form-label">Dosen Pembimbing</label>
                <ul class="list-group">
                    <?php
                    $id_target = "P001"; // ID yang ingin ditampilkan
                    foreach ($dosen as $dosen_item) {
                        if ($dosen_item['id'] === $prestasi["id"]) { // Cek apakah ID sesuai dengan target
                            echo '<li class="list-group-item">' . $dosen_item['nama'] . '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>

           <!-- Lampiran File -->
            <div class="mb-3">
                <label for="file-surat-tugas" class="form-label">File Surat Tugas</label>
                <a href="<?php echo '../../../' . $prestasi['file_surat_tugas']; ?>" class="btn btn-primary" target="_blank">Lihat Surat Tugas</a>
            </div>

            <div class="mb-3">
                <label for="file-sertifikat" class="form-label">File Sertifikat</label>
                <a href="<?php echo '../../../'.$prestasi['file_sertifikat']; ?>" class="btn btn-primary" target="_blank">Lihat Sertifikat</a>
            </div>

            <div class="mb-3">
                <label for="foto-kegiatan" class="form-label">Foto Kegiatan</label>
                <a href="<?php echo'../../../'.$prestasi['foto_kegiatan']; ?>" class="btn btn-primary" target="_blank">Lihat Foto</a>
            </div>

            <div class="mb-3">
                <div class="btn-container d-flex justify-content-start align-items-center">
                <label for="file-poster" class="form-label">File Poster</label>
                <a href="<?php echo '../../../' . $prestasi['file_poster']; ?>" class="btn btn-primary" target="_blank">Lihat Poster</a>
            </div>


            <!-- Tombol Validasi dan Tolak Validasi -->
            <div class="mb-3">
                <?php if ($prestasi["validasi"] == 0 && Session::get("role") == "1"): ?>


            <!-- Tombol Validasi -->
            <div class="mb-3 d-flex justify-content-start align-items-center">
            <form method="POST" action="/dashboard/admin/<?= $user ?>/detail-prestasi/validate" class="d-inline me-2">
                <input type="hidden" name="prestasi_id" value="<?php echo $prestasi['id']; ?>">
                <button type="submit" class="btn btn-validasi" name="action_validasi" value="validasi">Validasi</button>
            </form>

            <form method="POST" action="/dashboard/admin/<?= $user ?>/detail-prestasi/validate" class="d-inline">
                <input type="hidden" name="prestasi_id" value="<?php echo $prestasi['id']; ?>">
                <input type="hidden" name="mahasiswa_id" value="<?php echo $prestasi['id_mahasiswa']; ?>">
                <input type="hidden" name="judul_kompetisi" value="<?php echo $prestasi['judul_kompetisi']; ?>">
                <button type="submit" class="btn btn-tolak" name="action_tolak" value="tolak">Tolak Validasi</button>
            </form>
            </div>



                <?php elseif ($prestasi["validasi"] == 1): ?>
                    <!-- Pesan jika sudah divalidasi -->
                    <p>Sudah divalidasi oleh <?= htmlspecialchars($prestasi["admin_nama"], ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
            </div>
            <div class="container mt-5">


            </div>


        </form>
    </div>
</div>

<style>
    body {
        margin: 0;
        font-family: 'Galatea', sans-serif;
        background-color: #f5f5f5;
        color: white;
    }

    .btn-primary {
    color: #AFFA08; /* Mengubah warna teks menjadi putih */
    text-decoration: none; /* Menghilangkan underline */
    }

    .btn-primary:hover {
        color: white; /* Mengubah warna teks menjadi hijau saat hover */
        text-decoration: none; /* Menghilangkan underline */
    }


    .container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 30px;
    }

    .form-container {
        background-color: #0039C8;
        padding: 30px;
        padding-bottom: 50px;
        border-radius: 15px;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        min-height: 1200px;
        position: relative;
        max-width: 900px;
        margin: 0 auto;
    }

    .form-container h3 {
        color: #AFFA08;
        font-size: 35px;
        font-weight: 700;
		text-align: center;
    }

    .form-container label {
        color: rgba(255, 255, 255, 0.90);
        font-size: 20px;
        font-weight: 400;
    }

    .form-container input,
    .form-container select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 16px;
        border-radius: 25px;
        border: none;
        font-size: 16px;
    }

    .dosen-entry {
        margin-bottom: 16px;
    }

    .dosen-select {
        width: 100%;
        padding: 10px;
        border-radius: 25px;
        border: none;
        font-size: 16px;
        margin-top: 5px;
    }

    .btn-tambah {
        background-color: #AFFA08;
        padding: 10px 20px;
        border: none;
        border-radius: 25px;
        color: black;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        margin-bottom: 16px;
    }

    .btn-tambah:hover {
        background-color: #c5ff5f;
    }

    .form-container .submit-btn {
        background-color: #AFFA08;
        border-radius: 25px;
        padding: 10px 20px;
        color: black;
        font-size: 20px;
        font-weight: 500;
        text-align: center;
        cursor: pointer;
        border: none;
        position: absolute;
        bottom: 20px;
        right: 20px;
    }

    .form-container input[type="file"] {
        padding: 0;
        font-size: 16px;
    }
	
	.d-flex {
    display: flex;
    gap: 10px; /* Jarak antara tombol */
    }

    .justify-content-between {
        justify-content: space-between;
    }

    /* Tombol Validasi */
    .btn-validasi {
        width: 100px; /* Lebar konsisten */
        height: 30px;
        padding: 5px 10px; /* Padding yang sama */
        text-align: center; /* Teks di tengah */
        font-weight: bold; /* Membuat teks lebih menonjol */
        font-size: 16px; /* Ukuran font seragam */
        border-radius: 25px; /* Sudut membulat */
        background-color: #28a745; /* Warna hijau untuk Validasi */
        border: 2px solid #28a745; /* Border dengan warna hijau */
        color: white; /* Warna teks putih */
        cursor: pointer;
    }

    .btn-validasi:hover {
        background-color: #218838; /* Hijau lebih gelap saat hover */
        border-color: #218838;
    }

    /* Tombol Tolak */
    .btn-tolak {
        width: 130px; /* Lebar konsisten */
        height: 30px;
        padding: 5px 10px; /* Padding yang sama */
        text-align: center; /* Teks di tengah */
        font-weight: bold; /* Membuat teks lebih menonjol */
        font-size: 16px; /* Ukuran font seragam */
        border-radius: 25px; /* Sudut membulat */
        background-color: #dc3545; /* Warna merah untuk Tolak */
        border: 2px solid #dc3545; /* Border dengan warna merah */
        color: white; /* Warna teks putih */
        cursor: pointer;
    }

    .btn-tolak:hover {
        background-color: #c82333; /* Merah lebih gelap saat hover */
        border-color: #c82333;
    }

    .btn-container {
        margin-bottom: 20px; /* Atur jarak di bawah tombol */
    }

    #addDosenBtn {
        background-color: #AFFA08;
        padding: 5px 10px;
        border: none;
        border-radius: 25px;
        color: black;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
    }

    #addDosenBtn:hover {
        background-color: #c5ff5f;
    }
</style>