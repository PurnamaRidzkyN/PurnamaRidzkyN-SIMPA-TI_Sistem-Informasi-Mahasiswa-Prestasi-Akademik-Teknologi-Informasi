<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard JTI</title>
    <style>
        /* Importing Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Robot+Crush&family=Galatea&display=swap');

        body {
            background-color: white;
            /* Set the background to white */
            font-family: 'Galatea', sans-serif;
            color: white;
            margin: 0;
            padding: 0;
        }

        /* Navbar Styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            padding: 8px 20px;
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
            margin-right: 10px;
        }

        .navbar .logo h1 {
            font-size: 24px;
            font-weight: 700;
            color: white;
            letter-spacing: 0.5px;
        }

        .navbar .menu {
            display: flex;
            gap: 15px;
        }

        .navbar .menu a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            font-weight: 500;
        }

        .navbar .menu a:hover {
            color: #AFFA08;
        }

        /* Leaderboard Styles */
        .leaderboard-container {
            position: relative;
            width: 100%;
            height: 100%;
            padding: 10px;
        }

        .header-container {
            background: linear-gradient(135deg, #0039C8, #000000);
            /* Gradient blue to black */
            padding: 25px;
            border-radius: 10px;
            width: 79%;
            margin: 0 auto;
            text-align: center;
        }

        .header {
            font-size: 70px;
            font-style: italic;
            color: #AFFA08;
            font-weight: 400;
            font-family: 'Robot Crush', sans-serif;
            margin-bottom: 20px;
        }

        .rank-item {
            display: flex;
            align-items: center;
            background: #0039C8;
            /* Gradient blue to black */
            border-radius: 20px;
            margin: 15px 0;
            padding: 15px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            max-width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        .rank-item img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .rank-info {
            display: flex;
            flex-direction: column;
        }

        .rank-number {
            font-size: 60px;
            font-weight: 900;
            color: #AFFA08;
            /* Green color for rank number */
            margin-right: 15px;
        }

        .name {
            font-size: 30px;
            font-weight: 700;
            color: #AFFA08;
            /* Green color for name */
        }

        .details {
            font-size: 16px;
            color: #AFFA08;
            /* Green color for details */
        }

        .points {
            font-size: 30px;
            color: #AFFA08;
            /* Green color for points */
            font-weight: 700;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <img src="../../public/component/logoHijau.png" alt="Logo">
            <h1>SIMPA-TI</h1>
        </div>
        <div class="menu">
            <a href="#home">Home</a>
            <a href="#prestasi">Prestasi</a>
            <a href="#leaderboard">Leaderboard</a>
        </div>
    </div>

<?php

use app\cores\View;
use app\helpers\Dump;

 $leaderboard =View::getData();
 ?>
    <!-- Leaderboard Content -->
    <div class="leaderboard-container">
        <!-- Header Container with gradient blue to black -->
        <div class="header-container">
            <div class="header">LEADERBOARD JTI</div>
        </div>
        <!-- Loop through each rank in the leaderboard -->
        <?php foreach ($leaderboard as $rankItem): ?>
            <div class="rank-item">
                <div class="rank-number"><?php echo $rankItem['Rank']; ?></div>
                <img src=".<?php echo '../../'.$rankItem['Foto']; ?>" alt="User Image">
                <div class="rank-info">
                    <div class="name"><?php echo $rankItem['Nama_Mahasiswa']; ?></div>
                    <div class="details"><?php echo $rankItem['Program_Studi']; ?></div>
                    <div class="points"><?php echo $rankItem['Total_Skor']; ?> pts</div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    </div>
</body>

</html>