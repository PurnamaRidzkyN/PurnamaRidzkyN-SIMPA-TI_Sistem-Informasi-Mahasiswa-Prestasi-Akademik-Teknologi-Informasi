<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	
	<style>
		.navbar {
            display: flex;
            justify-content: space-between;
            padding: 10px 30px;
            background-color: #0039C8;
            color: white;
            align-items: center;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            width: 80px;
            height: 80px;
            margin-right: 15px;
        }

        .navbar .logo h1 {
            font-size: 30px;
            font-weight: 700;
            color: white;
            letter-spacing: 0.5px;
        }

        .navbar .menu {
            display: flex;
            gap: 20px;
        }

        .navbar .menu a {
            text-decoration: none;
            color: white;
            font-size: 20px;
            font-weight: 500;
        }

        .navbar .menu a:hover {
            color: #AFFA08;
        }

        /* Custom style for Daftar Mahasiswa */
        .daftar-mahasiswa-title {
            font-size: 5vw;
            font-family: 'Robot Crush', sans-serif;
            font-style: italic;
            font-weight: 400;
            color: #0039C8;
        }
	</style>
</head>
<body class="bg-light">
	
	<!-- Navbar -->
<div class="navbar">
    <div class="logo">
        <img src="logoHijau.png" alt="Logo">
        <h1>SIMPA-TI</h1>
    </div>
    <div class="menu">
        <a href="#home">Home</a>
        <a href="#prestasi">Prestasi</a>
        <a href="#leaderboard">Leaderboard</a>
    </div>
</div>

<div class="container mt-5">
    <h2 class="text-center mb-4 daftar-mahasiswa-title">Daftar Mahasiswa</h2>
    <div class="list-group">
        <?php foreach ($mahasiswa as $m): ?>
            <a href="/dashboard/<?= urlencode($m['nama']) ?>/detail-prestasi" class="list-group-item list-group-item-action">
                <?= htmlspecialchars($m['nama']) ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
