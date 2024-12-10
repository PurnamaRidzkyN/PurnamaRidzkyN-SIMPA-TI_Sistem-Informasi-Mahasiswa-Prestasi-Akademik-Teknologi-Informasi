<?php
use app\cores\Session;
use app\cores\View;
use app\helpers\Dump;

$user = Session::get('user');
$infoLomba = View::getData();
?>

<!-- Background Biru -->
<div class="background-blue">
    <div class="white-box">

        <!-- Navbar Biru -->
        <div class="navbar">
            <div class="logo">
                <img src="logoHijau.png" alt="Logo">
                <h1>SIMPA-TI</h1>
            </div>
            <div class="menu">
                <a href="#">Home</a>
                <a href="#">Prestasi</a>
                <a href="#">Leaderboard</a>
            </div>
            <div class="user-info">
                <!-- Notification Bubble -->
                <div class="notification-bubble" onclick="window.location.href='notif.php'">
                    <img src="notifikasi-03.png" alt="Notifikasi">
                    <div class="notification-count">3</div> <!-- Angka notifikasi -->
                </div>
                <img src="profilpic.png" alt="Profile">
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

        <section class="flex-center">
            <div class="main-container">

                <!-- Kolom Kiri: Sapaan -->
                <div class="left-container">
                    <div class="additional-content">
                        <div class="blue-box">
                            <!-- Gambar di dalam Kotak Biru -->
                            <img src="masti.png" alt="Image" class="image">
                            <!-- Teks Selamat Datang dan Siap Menjadi Juara di dalam Kotak Biru -->
                            <div class="text-container">
                                <div class="welcome-text">
                                    <span>Selamat Datang,</span> <span>Masti!</span>
                                </div>
                                <div class="ready-text">Sudah Siap Menjadi Juara?</div>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="upcoming-events">
                        <div class="header">Upcoming Events</div>
                        <div class="event-container">
                            <?php foreach ($events as $event): ?>
                                <div class="event-box">
                                    <div class="event-img">
                                        <img src="pamflet sportif 2024.jpg" alt="Event Image">
                                    </div>
                                    <div class="event-info">
                                        <div class="date"><?= $event['date'] ?></div>
                                        <div class="event-name"><?= $event['name'] ?></div>
                                        <div class="categories">
                                            <ul>
                                                <?php foreach ($event['categories'] as $category): ?>
                                                    <li><?= $category ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <div class="link">
                                            <a href="<?= $event['link'] ?>" target="_blank">Klik disini</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>

                <!-- Leaderboard Content -->
                <div class="leaderboard-container">
                    <div class="header-container">
                        <div class="header">LEADERBOARD</div>
                    </div>

                    <?php foreach ($leaders as $leader): ?>
                        <div class="rank-item">
                            <div class="rank-number"><?= $leader['rank'] ?></div>
                            <img src="profilpic.png" alt="User Image">
                            <div class="rank-info">
                                <div class="name"><?= $leader['name'] ?></div>
                                <div class="details"><?= $leader['details'] ?></div>
                                <div class="points"><?= $leader['points'] ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </section>

    </div>
</div>

<!-- Link ke Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    
 }

/* CSS untuk Body dan Umum */
body {
    margin: 0; /* Menghilangkan margin default browser */
    font-family: 'Galatea', sans-serif; /* Menentukan font yang digunakan */
    background-color: #f5f5f5; /* Warna latar belakang */
    color: black; /* Warna teks default */
}

/* Background Biru untuk desktop (full screen) */
.background-blue {
    display: flex;
    justify-content: space-between; /* Centering secara horizontal */
    align-items: center;     /* Centering secara vertikal */
    width: 100vw;            /* Menyesuaikan lebar dengan lebar viewport */
    background-color: #0039C8; /* Warna latar belakang biru */
    padding: 50px;           /* Menambahkan ruang di sekitar elemen putih */
    box-sizing: border-box;  /* Memastikan padding tidak mempengaruhi ukuran elemen */
}

/* Element putih di dalam background biru */
.white-box {
    width: 99%;               /* Menggunakan persen untuk lebar agar responsif */
    height: 99%;              /* Menggunakan persen untuk tinggi agar responsif */
    background-color: white; /* Warna latar belakang putih */
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); /* Menambahkan bayangan */
    border-radius: 50px;      /* Membuat sudut membulat */
    display: flex;
    flex-direction: column;
    padding: 10px;            /* Padding di dalam kotak putih */
    box-sizing: border-box;   /* Memastikan padding tidak mempengaruhi ukuran elemen */
}

/* Navbar Biru */
.navbar {
    display: flex;                      /* Menggunakan flexbox untuk layout */
    justify-content: space-between;     /* Menyebarkan elemen navbar secara merata */
    align-items: center;                /* Menyelaraskan elemen secara vertikal */
    padding: 0 20px;                    /* Menambahkan padding kiri dan kanan */
    background-color: #0039C8;          /* Warna latar belakang navbar */
    color: white;                       /* Warna teks di navbar */
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); /* Menambahkan bayangan navbar */
    height: 80px;                       /* Menetapkan tinggi navbar tetap */
}

/* Pastikan logo dan menu terpusat */
.navbar .logo,
.navbar .menu,
.navbar .user-info {
    display: flex;
    align-items: center;                /* Menyelaraskan secara vertikal */
}

/* Styling logo dalam navbar */
.navbar .logo img {
    width: 60px; /* Ukuran logo */
    height: auto; /* Ukuran proporsional */
    margin-right: 10px; /* Memberikan jarak antara logo dan teks */
}

.navbar .logo h1 {
    font-size: 28px; /* Ukuran font untuk nama website */
    font-weight: 700; /* Menebalkan font */
}

/* Menu Navbar */
.navbar .menu {
    gap: 30px; /* Jarak antar item-menu navbar */
}

.navbar .menu a {
    text-decoration: none;  /* Menghilangkan garis bawah pada link */
    color: white;           /* Warna teks link */
    font-size: 24px;        /* Ukuran font untuk menu */
    font-weight: 600;       /* Menebalkan teks */
    transition: color 0.3s ease; /* Efek transisi saat hover */
}

/* Efek hover untuk menu navbar */
.navbar .menu a:hover {
    color: #AFFA08; /* Warna hijau baru saat item-menu di-hover */
}

/* Informasi pengguna di navbar */
.navbar .user-info {
    gap: 16px; /* Jarak antar elemen info pengguna */
}

.navbar .user-info img {
    width: 40px; /* Ukuran gambar profil */
    height: 40px; /* Ukuran gambar profil */
    border-radius: 50%; /* Membuat gambar menjadi bulat */
}
/* Notification Bubble - Kotak Notifikasi */
.notification-bubble {
    position: relative;
    cursor: pointer;
}

/* Gambar dalam kotak notifikasi */
.notification-bubble img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

/* Angka notifikasi (lingkaran merah) */
.notification-count {
    position: absolute;
    top: -5px;    /* Posisi angka sedikit di atas gambar */
    right: -5px;  /* Posisi angka sedikit di kanan gambar */
    background-color: #FF5733; /* Ganti warna latar belakang */
    color: white;
    font-size: 12px;
    font-weight: bold;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Konten Header */
.header {
    margin-left: 3px; /* Menyesuaikan dengan posisi navbar */
    padding-top: 3px;   /* Memberikan ruang di atas header */
    display: flex;
    flex-direction: row; /* Menyusun elemen secara horizontal */
    gap: 10px; /* Memberikan jarak kecil antara Home dan Tanggal */
    align-items: center; /* Memastikan elemen sejajar secara vertikal */
}

/* Teks Home */
.header .home {
    font-size: 24px;     /* Ukuran font untuk teks HOME */
    font-weight: 700;    /* Menebalkan font */
    color: black;        /* Warna teks hitam */
    font-family: 'Galatea', sans-serif; /* Menetapkan font yang sesuai untuk Home */
    font-style: normal;  /* Menghilangkan efek miring */
}

/* Teks Tanggal */
.header .date {
    font-size: 18px;         /* Ukuran font untuk tanggal */
    font-weight: 400;        /* Berat font standar */
    color: rgba(0, 0, 0, 0.70); /* Warna teks dengan transparansi */
    font-family: 'Galatea', sans-serif; /* Menetapkan font yang sesuai untuk Tanggal */
    font-style: normal;      /* Menghilangkan efek miring */
}


/* Konten Utama */

/* Konten Sapaan */
.additional-content {
    display: flex;
    justify-content: flex-start;  /* Mengatur posisi kotak biru ke kiri */
    align-items: center;          /* Menjaga semua konten di dalam kotak biru sejajar secara vertikal */
    margin-top: -20px;             /* Memberikan jarak antara navbar dan kotak biru */
    width: 98%;                   /* Menentukan lebar kotak sapaan (lebih besar) */
    height: 200px;                /* Menambahkan tinggi untuk sapaan */
}
/* Kiri: Container untuk Upcoming Events dan Sapaan */

/* Kotak Biru */
.blue-box {
    display: flex;
    align-items: center;
    background-color: #0039C8;
    border-radius: 30px;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    padding: 20px;
    gap: 40px;
    width: 98%;
    height: 130px;
    overflow: visible;
    margin-top: -10px;
}

/* Gambar di dalam Kotak Biru */
.image {
    width: 121px;
    height: auto;
    position: relative;
    top: -15px;
    margin-right: 20px;
}

/* Teks dalam Kotak Biru */
.text-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
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

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: flex-start;
}

/* Container utama */
.container {
    display: flex;
    justify-content: space-between;
    padding: 20px;
    width: 100%;
}

/* Kiri: Upcoming Events */
.left-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
    width: 70%;
}

/* Upcoming Event Container */
.upcoming-events {
    background-color: #0039C8;
    border-radius: 30px;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    padding: 20px;
    width: 98%;
    overflow-y: auto; /* Menambahkan scroll vertikal jika konten melebihi tinggi */
    max-height: 650px; /* Menambahkan batas tinggi agar scroll aktif */
    margin-top: -25px;
}

/* Header Upcoming Event */
.upcoming-events .header {
    font-size: 32px;
    font-family: Galatea, sans-serif;
    font-weight: 700;
    color: #AFFA08;
    margin-bottom: 20px;
    position: relative; /* Menjaga header tetap di atas */
}
/* Kontainer untuk event */
.event-container {
    display: flex;
    flex-wrap: wrap;
    gap: 5px; /* Jarak antar event dalam satu baris */
    justify-content: space-between; /* Menyusun elemen dengan jarak yang konsisten */
    margin-bottom: 20px; /* Jarak antar baris */
}

/* Kotak event */
.event-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    background: rgba(217, 217, 217, 0.50);
    border-radius: 30px;
    border: 1px solid #AFFA08;
    padding: 10px;
    width: calc(33.33% - 10px); /* 33% lebar, dengan gap 5px antara setiap kotak */
    box-sizing: border-box; /* Agar padding dan margin tidak mempengaruhi lebar */
    text-align: center;
    justify-content: center; /* Menambahkan centering di vertikal */
    min-height: 400px; /* Menambahkan tinggi minimum agar gambar tidak terhimpit */
}


/* Gambar event */
.event-img {
    display: flex;
    justify-content: center; /* Menambahkan centering secara horizontal */
    align-items: flex-start; /* Memastikan gambar berada di bagian atas */
    width: 95%; /* Memastikan gambar tetap responsif */
    margin-bottom: 2px; /* Memberikan jarak antara gambar dan teks di bawahnya */
}

.event-img img {
    max-width: 210mm;   /* Ukuran maksimal gambar A4 (lebar) */
    max-height: 297mm;  /* Ukuran maksimal gambar A4 (tinggi) */
    width: 100%;        /* Gambar responsif mengikuti lebar container */
    height: auto;       /* Menjaga proporsi gambar agar tidak terdistorsi */
    object-fit: contain; /* Menjaga gambar tetap proporsional */
    border-radius: 15px; /* Membuat gambar memiliki sudut membulat */
}


.event-info {
    display: grid;
    grid-template-columns: 1fr 3fr; /* 1 kolom untuk date, 2 kolom untuk name, categories, dan link */
    gap: 10px; /* Jarak antar elemen */
    width: 100%; /* Menjamin lebar penuh */
    align-items: center;
    margin-top: 15px; /* Jarak atas dari gambar */
}
/* Tanggal event */
.event-info .date {
    font-size: 20px;
    font-weight: 600;
    color: blac; /* Teks menjadi putih */
    font-family: 'Galatea', sans-serif; 
    text-align: center; /* Centering teks dalam date */
    background-color: #AFFA08; /* Background hijau */
    padding: 8px 15px; /* Menambahkan padding agar bentuk bulat */
    border-radius: 50%; /* Membuat background menjadi bulat */
    grid-row: span 2; /* Membuat date menempati dua baris */
}
/* Nama event */
.event-info .event-name {
    font-size: 24px;
    font-weight: 700;
    color: black;
    font-family: 'Galatea', sans-serif; 
    text-align: left; /* Nama event di kiri */
}

/* Kategori event */
.event-info .categories {
    font-size: 20px;
    color: #333333;
    font-family: 'Galatea', sans-serif;
    text-align: left; /* Kategori juga di kiri */
}
/* Link */
.event-info .link {
    font-size: 18px;
    text-decoration: none;
    color: #0039C8;
    cursor: pointer;
    margin-top: -15px; /* Memberikan jarak kecil antara kategori dan link */
    text-align: left; /* Menyelaraskan dengan kategori */
    grid-column: 2; /* Memastikan link berada di bawah kategori */
}

/* Konten Utama */
.main-container {
    display: flex;
    justify-content: space-between;  /* Menyusun elemen secara horizontal */
    align-items: flex-start;  /* Menyusun elemen di atas */
    margin-top: 20px;
    width: 100%;
}

/* Leaderboard */
.leaderboard-container {
    width: 100%;
    padding: 10px; /* Mengurangi padding sedikit untuk memperkecil ruang di dalam */
    background: linear-gradient(174deg, black 0%, #0039C8 26%, rgba(217, 217, 217, 0.50) 92%); 
    border-radius: 20px;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    height: 850px;
}



/* Header Leaderboard */
.header-container {
    background-color: #0039C8;
    padding: 12px;  /* Mengurangi padding pada header */
    border-radius: 10px;
    width: 90%;
    margin: 0 auto;
    text-align: center;
}

/* Nama Leaderboard */
.header {
    font-size: 40px;  /* Ukuran font lebih kecil untuk header */
    font-style: italic;
    color: #AFFA08;
    font-weight: 400;
    font-family: 'Robot Crush', sans-serif;
    margin-bottom: 15px;  /* Memberikan jarak lebih sedikit antara header dan isi */
}

/* Rank Item */
.rank-item {
    display: flex;
    align-items: center;
    background: #AFFA08;
    border-radius: 20px;
    margin: 10px 0;  /* Mengurangi margin antara rank */
    padding: 10px;  /* Mengurangi padding untuk memperkecil ukuran item */
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    max-width: 100%;
}

/* Gambar pada Rank */
.rank-item img {
    width: 70px;  /* Memperkecil ukuran gambar */
    height: 70px; /* Memperkecil ukuran gambar */
    border-radius: 50%;
    margin-right: 10px;  /* Mengurangi jarak antara gambar dan teks */
}

/* Informasi pada Rank */
.rank-info {
    display: flex;
    flex-direction: column;
}

/* Nama Pengguna */
.name {
    font-size: 24px; /* Mengurangi ukuran font nama */
    font-weight: 700;
    color: #0039C8;
}

/* Detail Pengguna */
.details {
    font-size: 14px;  /* Mengurangi ukuran font untuk detail */
    color: rgba(10, 10, 10, 0.9);
}

/* Poin Pengguna */
.points {
    font-size: 24px; /* Mengurangi ukuran font untuk poin */
    color: #0039C8;
    font-weight: 700;
}

/* Nomor Peringkat */
.rank-number {
    font-size: 40px; /* Mengurangi ukuran nomor peringkat */
    font-weight: 900;
    color: rgba(15, 14, 14, 0.3);
    margin-right: 10px;
}


.flex-center {
    display: grid;
    gap: 20px;
    grid-template-columns: auto auto;
}

.main-container {
    width: fit-content;
}

.left-container{
 width: 100%;   
}
</style>