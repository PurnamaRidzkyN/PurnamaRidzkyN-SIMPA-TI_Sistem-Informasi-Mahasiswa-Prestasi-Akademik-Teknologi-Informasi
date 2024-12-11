<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Galatea:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Galatea, sans-serif;
            background-color: #f5f5f5;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            padding: 8px;
            background-color: #0039C8;
            color: white;
            align-items: center;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            width: 60px;
            height: 60px;
            margin-right: 8px;
        }

        .navbar .logo h1 {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 0.32px;
        }

        .navbar .menu {
            display: flex;
            gap: 16px;
        }

        .navbar .menu a {
            text-decoration: none;
            color: white;
            font-size: 20px;
            font-weight: 500;
        }

        .navbar .menu a:hover {
            color: #AFFA08;
            /* Warna hijau saat hover */
        }

        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .navbar .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .navbar .user-info .notifications {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .header {
            margin-top: 2px;
            padding: 10px;
            display: flex;
            justify-content: flex-start;
            gap: 20px;
            align-items: center;
            padding-left: 20px;
        }

        .header .home {
            font-size: 24px;
            font-weight: 700;
            color: black;
            font-family: 'Galatea', sans-serif;
            font-style: normal;
        }

        .header .date {
            font-size: 18px;
            font-weight: 400;
            color: rgba(0, 0, 0, 0.70);
            font-family: 'Galatea', sans-serif;
            font-style: normal;
        }

        .main-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-top: 20px;
        }

        .left-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 70%;
            padding-left: 20px;
        }

        .blue-box {
            display: flex;
            align-items: center;
            background-color: #0039C8;
            border-radius: 30px;
            padding: 20px;
            gap: 40px;
            width: 100%;
            height: 130px;
        }

        .blue-box {
            display: flex;
            align-items: center;
            background-color: #0039C8;
            border-radius: 30px;
            padding: 20px;
            gap: 40px;
            width: 100%;
            height: 130px;
            position: relative;
        }

        .image-container {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            flex-grow: 1;
            position: relative;
        }

        .image {
            width: 105px;
            height: auto;
            object-fit: cover;
            position: relative;
            bottom: 20px;
        }

        .text-container {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .welcome-text {
            font-size: 28px;
            font-weight: 700;
            color: #AFFA08;
        }

        .ready-text {
            font-size: 20px;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Upcoming Events Styling */
        .upcoming-events {
            background-color: #0039C8;
            border-radius: 30px;
            padding: 20px;
            width: 100%;
            max-height: 650px;
            overflow-y: auto;
        }

        .upcoming-events .header {
            font-size: 32px;
            font-family: Galatea, sans-serif;
            font-weight: 700;
            color: #AFFA08;
            margin-bottom: 20px;
            position: relative;
            /* Menjaga header tetap di atas */
        }

        .event-container {
            display: flex;
            flex-wrap: wrap;
            /* Memungkinkan kotak untuk membungkus ke baris berikutnya */
            gap: 10px;
            /* Jarak antar kartu */
            justify-content: space-between;
            /* Menyebar ruang antar item */
        }

        .event-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(217, 217, 217, 0.50);
            border: 2px solid #AFFA08;
            border-radius: 15px;
            padding: 10px;
            width: calc(23% - 10px);
            min-height: 200px;
            /* Menjaga tinggi minimum */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s ease;
        }

        .event-box:hover {
            transform: scale(1.3);
            /* Membesarkan kotak saat hover */
            z-index: 1;
            /* Mengangkat kotak di atas yang lain saat hover */
        }

        .event-img {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            /* Memastikan gambar mengambil lebar penuh */
            margin-bottom: 5px;
            /* Jarak antara gambar dan informasi */
        }

        .event-img img {
            width: auto;
            /* Mengatur lebar gambar secara otomatis */
            height: auto;
            /* Mengatur tinggi gambar secara otomatis */
            max-height: 180px;
            /* Mengatur tinggi maksimum gambar menjadi 150px */
            max-width: 250px;
            /* Mengatur lebar maksimum gambar menjadi 200px */
            object-fit: cover;
            /* Memastikan gambar terpotong dengan baik */
            border-radius: 10px;
            /* Menambahkan sudut melengkung */
        }

        .event-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            margin-top: 10px;
            /* Jarak atas untuk informasi */
        }

        /* Tanggal event */
        .event-info .date {
            font-size: 16px;
            font-weight: 600;
            color: blac;
            /* Teks menjadi putih */
            font-family: 'Galatea', sans-serif;
            text-align: center;
            /* Centering teks dalam date */
            background-color: #AFFA08;
            /* Background hijau */
            padding: 5px 10px;
            /* Menambahkan padding agar bentuk bulat */
            border-radius: 80%;
            /* Membuat background menjadi bulat */
        }

        /* Nama event */
        .event-info .event-name {
            font-size: 16px;
            font-weight: 700;
            color: black;
            font-family: 'Galatea', sans-serif;

        }

        /* Kategori event */
        .event-info .categories {
            font-size: 12px;
            color: #333333;
            font-family: 'Galatea', sans-serif;
        }

        /* Link */
        .event-info .link {
            font-size: 12px;
            text-decoration: none;
            color: #0039C8;
            cursor: pointer;
            margin-top: -15px;
            /* Memberikan jarak kecil antara kategori dan link */
            text-align: left;
            /* Menyelaraskan dengan kategori */
            grid-column: 2;
            /* Memastikan link berada di bawah kategori */
        }


        /* Leaderboard Styling */
        .leaderboard {
            background: linear-gradient(174deg, black 0%, #0039C8 26%, rgba(217, 217, 217, 0.50) 92%);
            border-radius: 20px;
            padding: 10px;
            width: 25%;
            /* Menentukan lebar untuk leaderboard */
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            height: 850px;
            margin-left: 20px;
            /* Menambahkan margin kiri untuk menggeser ke kiri */
        }

        .header-container {
            background-color: #0039C8;
            padding: 12px;
            border-radius: 10px;
            width: 90%;
            margin: 0 auto;
            text-align: center;
        }

        .header {
            font-size: 40px;
            /* Ukuran font lebih kecil untuk header */
            font-style: italic;
            color: #AFFA08;
            font-weight: 400;
            font-family: 'Robot Crush', sans-serif;
            margin-bottom: 15px;
            /* Memberikan jarak lebih sedikit antara header dan isi */
        }


        .rank-item {
            display: flex;
            align-items: center;
            background: #AFFA08;
            border-radius: 20px;
            margin: 10px 0;
            padding: 10px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        }

        .rank-item img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .rank-info {
            display: flex;
            flex-direction: column;
        }

        .name {
            font-size: 24px;
            font-weight: 700;
            color: #0039C8;
        }

        .details {
            font-size: 14px;
            color: rgba(10, 10, 10, 0.9);
        }

        .points {
            font-size: 24px;
            color: #0039C8;
            font-weight: 700;
        }

        .rank-number {
            font-size: 40px;
            font-weight: 900;
            color: rgba(15, 14, 14, 0.3);
            margin-right: 10px;
        }

        /* Ensure responsiveness */
        @media (max-width: 768px) {
            .leaderboard {
                width: 100%;
                height: auto;
            }

            .rank-item {
                flex-direction: column;
                text-align: center;
            }

            .rank-item img {
                margin-bottom: 10px;
            }

            .rank-number {
                margin-right: 0;
            }
        }
    </style>
</head>
<?php

use app\cores\Session;
use app\models\database\users\Mahasiswa; ?>
<!-- Navbar -->
<div class="navbar">
    <div class="logo">
        <img src="../../../public/component/logoHijau.png" alt="Logo">
        <h1>SIMPA-TI</h1>
    </div>
    <div class="menu">
        <a href="#">Home</a>
        <a href=<?php echo '/dashboard/mahasiswa/' . Session::get("user") . '/prestasi' ?>>Prestasi</a>
        <a href="#">Leaderboard</a>
    </div>
    <div class="user-info">
        <!-- Notification Bubble -->
        <div class="notification-bubble" onclick="window.location.href='notifikasi.html'">
            <img src="./../../public/component/notifikasi-03.png" alt="Notifikasi">
        </div>

        <img src="../../../public/component/profilpic.png" alt="Profile">
    </div>
</div>

<!-- Konten Header -->
<div class="header">
    <div class="home">HOME</div>
    <div class="date">
        <?php
        // Set timezone jika diperlukan

        date_default_timezone_set('Asia/Jakarta'); // Zona waktu Jakarta
        echo date('d F Y'); // Menampilkan tanggal saat ini dalam format Hari Bulan Tahun
        ?>
    </div>
</div>
<div class="main-container">
    <div class="left-container">
        <div class="blue-box">
            <img class="image" src="../../../public/component/masti.png" alt="Image">
            <div class="text-container">
                <div class="welcome-text">Selamat Datang, <?php echo Mahasiswa::findNim(Session::get("user"))["result"][0]["nama"]; ?></div>
                <div class="ready-text">Sudah Siap Menjadi Juara?</div>
            </div>
        </div>
        <div class="upcoming-events">
            <div class="header">Upcoming Events</div>
            <div class="event-container">
                <?php
                // Data event disimpan dalam array
                use app\cores\View;
                use app\helpers\Dump;

                $data = View::getData();
                $events = $data["info_lomba"]["result"];
                // Dump::out($events);

                // Loop untuk menampilkan setiap event
                foreach ($events as $event) {
                    echo '<div class="event-box">';
                    echo '    <div class="event-img">';
                    echo '        <img src="../../../' . $event['file_poster'] . '" alt="Event Image">';
                    echo '    </div>';
                    echo '    <div class="event-info">';
                    echo '        <div class="date">' . $event['tanggal_akhir_pendaftaran'] . '</div>';
                    echo '        <div class="event-name">' . $event['judul'] . '</div>';
                    echo '        <div class="categories">';
                    echo '            <ul>';
                    echo ($event['deskripsi_lomba']);
                    echo '            </ul>';
                    echo '        </div>';
                    echo '        <div class="link"><a href="' . $event['link_perlombaan'] . '" target="_blank">Klik disini</a></div>';
                    echo '    </div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Right Side (Empty or Add More Content) -->
    <div class="leaderboard">
        <!-- Header Leaderboard -->
        <div class="header-container">
            <div class="header">LEADERBOARD</div>
        </div>

        <?php


        // Data leaderboard
        $data = View::getData();
        $leaderboardData = $data["leaderboard"]["result"];
        // Dump::out($data);
        // Render leaderboard
        foreach ($leaderboardData as $item) {
            echo '<div class="rank-item">';
            echo '<div class="rank-number">' . $item['rank'] . '</div>';
            echo '<img src="' . $item['image'] . '" alt="User Image">';
            echo '<div class="rank-info">';
            echo '<div class="name">' . $item['Nama_Mahasiswa'] . '</div>';
            echo '<div class="details">' . $item['Program_Studi'] . '</div>';
            echo '<div class="points">' . $item['Total_Skor'] . ' pts</div>';
            echo '</div>'; // rank-info
            echo '</div>'; // rank-item
        }
        ?>

</html>