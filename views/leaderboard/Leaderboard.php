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

    <!-- Big Banner -->
    <section class="big-banner">
        <h1 class="leaderboard-title">LEADERBOARD</h1>
        <p class="banner-caption">AYO CEK RANKMU SEKARANG!</p>
    </section>

    <!-- Table Section (JTI, TI, SIB) -->
    <section class="leaderboard-table">
        <div class="table-link">
            <a href="leaderboard/all">
                <p class="table-title">JTI</p>
            </a>
        </div>
        <div class="table-link">
            <a href="/leaderboard/LeadearboardTI">
                <p class="table-title">TI</p>
            </a>
        </div>
        <div class="table-link">
            <a href="/leaderboard/LeaderboardSIB">
                <p class="table-title">SIB</p>
            </a>
        </div>
    </section>

    <!-- Link ke Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
