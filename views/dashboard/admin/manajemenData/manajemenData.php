<?php

use app\cores\Session;

$user = Session::get('user');
?>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJv+Kns0t1gXW9iIXEPKsnjDpXNO2kCeqhjnd/yjy3+9h+ptpIYef95yaoTG" crossorigin="anonymous">
<!-- Optional: Custom CSS for styling -->
<style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content {
        flex-grow: 1;
        padding: 20px;
    }

    .navbar-brand {
        font-size: 1.5rem;
    }
</style>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Prestasi</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo '../' . $user ; ?>">Home</a>
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


<!-- Main Content -->
<div class="main-content content">
    <h1>Dashboard</h1>
    <p>Selamat datang di Dashboard Prestasi</p>

    <!-- Add content or components here -->
    <div class="container">
        <!-- Example Card Content -->
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Admin</h5>
                        <p class="card-text">Akses data terkait admin di sini.</p>
                        <a href="<?php echo '../' . $user . '/admin-data'; ?>" class="btn btn-primary">Lihat Data</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Mahasiswa</h5>
                        <p class="card-text">Akses data terkait mahasiswa di sini.</p>
                        <a href="<?php echo '../' . $user . '/mahasiswa-data'; ?>" class="btn btn-primary">Lihat Data</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Dosen</h5>
                        <p class="card-text">Akses data terkait dosen di sini.</p>
                        <a href="<?php echo '../' . $user . '/dosen-data'; ?>" class="btn btn-primary">Lihat Data</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Log Data </h5>
                        <p class="card-text">Akses data terkait Log di sini.</p>
                        <a href="<?php echo '../' . $user . '/log-data'; ?>" class="btn btn-primary">Lihat Data</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybK0W6+Rb6PbIuGQkzjzAi2Jo8w0Jg5t5pU8v2v5dB8Qq5M0p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-cQQA8wLlD6v2eYPq/7MlR0cJpbA0DkHovQDxwyIHKnqA8n1nDmgzRpmzThI2FTpl" crossorigin="anonymous"></script>