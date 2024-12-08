<?php

use app\cores\Session;

$user = Session::get('user');
?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo '../admin/' . $user . '/prestasi'; ?>">Prestasi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Leaderboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Manajemen Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <!-- Dropdown untuk profil -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Profil
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/change-password">Ubah Kata Sandi</a></li>
            <li><a class="dropdown-item" href="/logout">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Dashboard Content -->
<div class="container mt-5">
  <div class="row">
    <div class="col-md-12">
      <h2>Selamat datang di Dashboard</h2>
      <p>Ini adalah halaman utama dashboard, kamu bisa menambahkan konten di sini.</p>
      <div class="card">
        <div class="card-header">
          Konten Dashboard
        </div>
        <div class="card-body">
          <h5 class="card-title">Fitur Dashboard</h5>
          <p class="card-text">Tambahkan informasi penting atau data terkait dashboard di sini.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS and Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
