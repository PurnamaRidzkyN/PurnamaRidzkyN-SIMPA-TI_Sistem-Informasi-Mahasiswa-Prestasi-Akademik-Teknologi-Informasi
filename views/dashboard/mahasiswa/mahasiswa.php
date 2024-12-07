<?php

use app\cores\Session;

$user = Session::get('user');
?>
    <!-- Navbar -->
    <div class="navbar">
        <a href="#">Beranda</a>
        <a href="#">Profil</a>
        <a href="<?php echo '/dashboard/mahasiswa/' . $user . '/upload'; ?>">Prestasi</a>
        <a href="/logout">Logout</a>
    </div>

    <!-- Content -->
    <div class="container">
        <h1 class="dashboard-title">Selamat Datang di Dashboard Mahasiswa</h1>

        <div class="dashboard-box">
            <div>
                <h2>Unggah Prestasi</h2>
                <p>Unggah prestasi akademik atau kompetisi yang diikuti.</p>
                <a href="upload-prestasi.html">Unggah Sekarang</a>
            </div>

            <div>
                <h2>Daftar Prestasi</h2>
                <p>Lihat dan kelola prestasi yang telah diunggah.</p>
                <a href="#">Lihat Prestasi</a>
            </div>
        </div>
    </div>
