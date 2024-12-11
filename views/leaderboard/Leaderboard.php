<?php

use app\cores\View;
use app\helpers\Dump;

$leaderboard = View::getData();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard Page</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Galatea', sans-serif;
            background-color: #f5f5f5;
            color: white;
        }

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

        .big-banner {
            height: 40vh;
            background: linear-gradient(270deg, #0039C8 0%, #001C62 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
            position: relative;
        }

        .leaderboard-title {
            font-size: 6vw;
            font-family: 'Robot Crush', sans-serif;
            font-style: italic;
            font-weight: 400;
            color: #AFFA08;
        }

        .banner-caption {
            font-size: 3vw;
            font-family: 'Galatea', sans-serif;
            font-weight: 700;
            color: white;
        }

        /* Filter Section */
        .filter-section {
            background-color: #0039C8;
            padding: 30px;
        }

        .filter-title {
            font-size: 50px;
            font-family: 'Galatea', sans-serif;
            font-weight: 700;
            color: #AFFA08;
            text-align: center;
        }

        .filters {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 20px;
        }

        .filter-btn {
            background-color: rgba(0, 0, 0, 0.50);
            color: #AFFA08;
            padding: 20px 70px;
            font-size: 2rem;
            font-weight: 800;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .filter-btn:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        /* Leaderboard Tables */
        .leaderboard-table {
            display: flex;
            justify-content: space-evenly;
            padding: 20px 5vw;
            flex-wrap: wrap;
            width: 100%;
            box-sizing: border-box;
        }

        .table-link {
            text-align: center;
            width: 28%;
            margin-bottom: 20px;
            margin-right: 15px;
            box-sizing: border-box;
        }

        /* Remove right margin on last item */
        .table-link:last-child {
            margin-right: 0;
        }

        .table-title {
            font-size: 6vw;
            font-family: 'Robot Crush', sans-serif;
            font-style: italic;
            font-weight: 400;
            color: #AFFA08;
            margin-top: 15px;
        }

        .table-link a {
            display: inline-block;
            font-size: 1.8rem;
            font-family: 'Galatea', sans-serif;
            font-weight: 800;
            color: white;
            background-color: #0039C8;
            padding: 12px 25px;
            border-radius: 30px;
            transition: background-color 0.3s;
            width: 100%;
            text-align: center;
        }

        .table-link a:hover {
            background-color: #001C62;
        }

        /* Media Query for Responsiveness */
        @media (max-width: 768px) {
            .leaderboard-table {
                flex-direction: column;
                align-items: center;
                padding: 20px 5vw;
            }

            .table-link {
                width: 80%;
                margin-bottom: 15px;
            }

            .table-title {
                font-size: 30vw;
            }

            .table-link a {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

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

    <!-- Big Banner -->
    <section class="big-banner">
        <h1 class="leaderboard-title">LEADERBOARD</h1>
        <p class="banner-caption">AYO CEK RANKMU SEKARANG!</p>
    </section>

    <!-- Filter Section -->
    <section class="filter-section">
        <h2 class="filter-title">FILTER</h2>
        <div class="filters">
            <button class="filter-btn">TINGKAT 1</button>
            <button class="filter-btn">TINGKAT 2</button>
            <button class="filter-btn">TINGKAT 3</button>
            <button class="filter-btn">TINGKAT 4</button>
        </div>
    </section>

    <!-- Table Section (JTI, TI, SIB) -->
    <section class="leaderboard-table">
        <div class="table-link">
            <a href="/dashboard/leaderboard/all">
                <p class="table-title">JTI</p>
            </a>
        </div>
        <div class="table-link">
            <a href="leaderboardTI.php">
                <p class="table-title">TI</p>
            </a>
        </div>
        <div class="table-link">
            <a href="leaderboardSIB.php">
                <p class="table-title">SIB</p>
            </a>
        </div>
    </section>

    <!-- Link ke Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
