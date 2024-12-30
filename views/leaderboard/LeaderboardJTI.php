<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard JTI</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Robot+Crush&family=Galatea&display=swap');

        body {
            background-color: white;
            font-family: 'Galatea', sans-serif;
            color: white;
            margin: 0;
            padding: 0;
        }

        .leaderboard-container {
            position: relative;
            width: 100%;
            height: 100%;
            padding: 10px;
        }

        .header-container {
            background: linear-gradient(135deg, #0039C8, #000000);
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
            margin-right: 15px;
        }

        .name {
            font-size: 30px;
            font-weight: 700;
            color: #AFFA08;
        }

        .details {
            font-size: 16px;
            color: #AFFA08;
        }

        .points {
            font-size: 30px;
            color: #AFFA08;
            font-weight: 700;
        }
    </style>
</head>

<body>

<?php

use app\cores\View;
use app\helpers\Dump;

$leaderboard = View::getData();

?>

<div class="leaderboard-container">
    <div class="header-container">
        <div class="header">LEADERBOARD JTI</div>
    </div>

    <?php foreach ($leaderboard as $rankItem): ?>
        <div class="rank-item">
            <div class="rank-number"><?php echo $rankItem['Rank']; ?></div>
            <img src=".<?php echo '../../../'.$rankItem['Foto']; ?>" alt="User Image">
            <div class="rank-info">
                <div class="name"><?php echo $rankItem['Nama_Mahasiswa']; ?></div>
                <div class="details"><?php echo $rankItem['Program_Studi']; ?></div>
                <div class="points"><?php echo $rankItem['Total_Skor']; ?> pts</div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>

</html>