<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php

          use app\cores\Session;

          echo \app\cores\View::getTitle() ?></title>
  <link rel="stylesheet" href="/public/css/login.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* Navbar */
    nav.navbar {
      display: flex;
      justify-content: space-between;
      padding: 12px 16px;
      /* Padding lebih nyaman */
      background-color: #0039C8;
      color: white;
      align-items: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      /* Tambahkan bayangan */
    }

    nav.navbar .logo {
      display: flex;
      align-items: center;
    }

    nav.navbar .logo img {
      width: 50px;
      /* Ukuran lebih proporsional */
      height: 50px;
      margin-right: 8px;
    }

    nav.navbar .logo h1 {
      font-size: 24px;
      font-weight: 700;
      margin: 0;
      /* Hapus margin default */
      letter-spacing: 0.5px;
    }

    nav.navbar .menu {
      display: flex;
      gap: 20px;
      /* Jarak antar link */
    }

    nav.navbar .menu a {
      text-decoration: none;
      color: white;
      font-size: 18px;
      font-weight: 500;
      transition: color 0.3s ease;
      /* Smooth transition */
    }

    nav.navbar .menu a:hover {
      color: #AFFA08;
      /* Warna hijau saat hover */
    }

    nav.navbar .user-info {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    nav.navbar .user-info img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }

    nav.navbar .notification-bubble {
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
    }

    nav.navbar .notification-bubble img {
      width: 100%;
      height: auto;
    }
    .login-text {
            font-size: 18px;
            color: white;
            padding: 10px 15px;
            border: 2px solid white;
            border-radius: 20px;
            background-color: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 40px;
            transition: background-color 0.3s;

        }

        .login-text a {
            text-decoration: none;
            /* Menghapus underline */
            color: inherit;
            /* Menggunakan warna teks induk */
        }


        .login-text:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

  </style>
</head>

<body>
  <nav class="navbar">
    <div class="logo">
      <img src="../../../public/component/logoHijau.png" alt="Logo">
      <h1>SIMPA-TI</h1>
    </div>
    <div class="menu">
      <?php if (Session::get("role") === "1"): ?>
        <a href=<?php echo '/dashboard/admin/' . Session::get("user") ?>>Home</a>
        <a href=<?php echo '/dashboard/admin/' . Session::get("user") . '/daftar-mahasiswa' ?>>Prestasi</a>
        <a href=<?php echo '/dashboard/admin/' . Session::get("user") . '/manajemen-data' ?>>Manajemen Data</a>
      <?php elseif (Session::get("role") === "2"): ?>
        <a href=<?php echo '/dashboard/mahasiswa/' . Session::get("user") ?>>Home</a>
        <a href=<?php echo '/dashboard/mahasiswa/' . Session::get("user") . '/prestasi' ?>>Prestasi</a>
      <?php else: ?>
        <a href="/">Home</a>
      <?php endif; ?>
      <a href="/leaderboard">Leaderboard</a>

    </div>

    <div class="user-info">
      <?php if (Session::get("role") === "1"): ?>
        <!-- Jika role Admin -->
        <div class="notification-bubble" onclick="window.location.href='<?php echo '/dashboard/admin/' . Session::get("user") . '/notifikasi'; ?>'">
          <img src="../../../public/component/notifikasi-03.png" alt="Notifikasi">
        </div>
        <a href="<?php echo '/dashboard/admin/' . Session::get("user") . '/profil'; ?>">
          <img src="../../../public/component/profilpic.png" alt="Profile">
        </a>
      <?php elseif (Session::get("role") === "2"): ?>
        <!-- Jika role Mahasiswa -->
        <div class="notification-bubble" onclick="window.location.href='<?php echo '/dashboard/mahasiswa/' . Session::get("user") . '/notifikasi'; ?>'">
          <img src="../../../public/component/notifikasi-03.png" alt="Notifikasi">
        </div>
        <a href="<?php echo '/dashboard/mahasiswa/' . Session::get("user") . '/profil'; ?>">
          <img src="../../../public/component/profilpic.png" alt="Profile">
        </a>
      <?php else: ?>
        <div class="login-text">
          <a href="/login">Login</a>
        </div>
      <?php endif; ?>
    </div>
  </nav>