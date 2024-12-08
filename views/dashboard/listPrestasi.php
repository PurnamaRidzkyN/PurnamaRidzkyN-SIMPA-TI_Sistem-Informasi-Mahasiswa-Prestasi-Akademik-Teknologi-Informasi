<?php

use app\cores\Session;

$user = Session::get('user');
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Prestasi</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Prestasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Tombol Upload Prestasi -->
<div class="container my-4">
    <a href=<?php echo '../'. $user.'/upload-prestasi';?> class="btn btn-primary btn-lg">Upload Prestasi</a>
</div>

<!-- Data Grid -->
<div class="container my-4">
    <div class="row">
        <?php
        // Contoh data array yang akan ditampilkan

        use app\cores\View;
        use app\helpers\Dump;

        $data = View::getData();
        // Looping untuk menampilkan data dalam grid
        $prestasi = $data;
        // Looping untuk menampilkan data dalam grid
        foreach ($prestasi as $item) {
            echo '<div class="col-md-4 mb-4">';
            echo '    <div class="card">';
            echo '        <div class="card-body">';
            echo '            <h5 class="card-title">' . $item['judul_kompetisi'] . '</h5>';
            echo '            <p class="card-text">Status: ' . ($item['validasi'] == 1 ? 'Sudah Divalidasi' : 'Belum Divalidasi') . '</p>';

            // Menampilkan nama admin jika validasi sudah dilakukan
            if ($item['validasi'] == 1) {
                echo '            <p class="card-text">Divalidasi oleh Admin: ' . $item['admin_nama'] . '</p>';
            }
            echo '            <p class="card-text">Skor: ' . $item['skor'] . '</p>';
            echo '            <a href="detail.php?id= " class="btn btn-success">Detail Prestasi</a>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
        }

        ?>
    </div>
</div>

<!-- Link ke Bootstrap JS dan Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>