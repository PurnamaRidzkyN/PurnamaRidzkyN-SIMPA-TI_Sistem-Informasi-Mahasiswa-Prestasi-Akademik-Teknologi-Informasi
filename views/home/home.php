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
            font-size: 20px;
            font-weight: 700;
            color: rgb(82, 78, 78);
            font-family: 'Galatea', sans-serif;
            font-style: normal;
        }

        .main-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-top: 20px;
            flex-wrap: wrap;
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
            font-size: 24px;
            font-weight: 400;
            color: #ffffff;
            padding: 20px;
        }
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
        }

        .event-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s ease;
        }

        .event-box:hover {
            transform: scale(1.3);
            z-index: 1;
        }

        .event-img {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-bottom: 5px;
        }

        .event-img img {
            width: auto;
            height: auto;
            max-height: 180px;
            max-width: 250px;
            object-fit: cover;
            border-radius: 10px;
        }

        .event-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            margin-top: 10px;
        }

        .event-info .date {
            font-size: 16px;
            font-weight: 600;
            color: black;
            font-family: 'Galatea', sans-serif;
            text-align: center;
            background-color: #AFFA08;
            padding: 5px 10px;
            border-radius: 80%;
        }

        .event-info .event-name {
            font-size: 16px;
            font-weight: 700;
            color: black;
            font-family: 'Galatea', sans-serif;

        }

        .event-info .categories {
            font-size: 12px;
            color: #333333;
            font-family: 'Galatea', sans-serif;
        }
        .event-info .link {
            font-size: 12px;
            text-decoration: none;
            color: #0039C8;
            cursor: pointer;
            margin-top: -15px;
            text-align: left;
            grid-column: 2;
        }

        .leaderboard {
            background: linear-gradient(174deg, black 0%, #0039C8 26%, rgba(217, 217, 217, 0.50) 92%);
            border-radius: 20px;
            padding: 10px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            height: 850px;
            margin-left: 10px;
        }

        .header-container {
            background-color: none;
            padding: 12px;
            border-radius: 10px;
            width: 90%;
            margin: 0 auto;
            text-align: center;
        }

        .header {
            font-size: 40px;
            font-style: italic;
            color: #AFFA08;
            font-weight: 400;
            font-family: 'Robot Crush', sans-serif;
            margin-bottom: 15px;
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


<!-- Konten Header -->
<div class="header">
    <div class="home">Sistem Informasi Mahasiswa Berprestasi Teknologi Informasi</div>
</div>
<div class="main-container">
    <div class="left-container">
        <div class="blue-box">
            <img class="image" src="../../../public/component/masti.png" alt="Image">
            <div class="text-container">
                <div class="welcome-text">Platform ini dirancang untuk membantu mahasiswa memantau peringkat, mengetahui informasi event mendatang, dan mengelola pencapaian prestasi. Login untuk mengakses fitur lengkap dan raih prestasi terbaikmu!
                </div>
            </div>
        </div>
        <div class="upcoming-events">

            <div class="header">Upcoming Events</div>
            <div class="event-container">
                <?php
                // Data event dalam array

                use app\cores\View;
                use app\helpers\Dump;

                $data = View::getData();
                $leaderboardData = $data["Leaderboard"]["result"];
                $eventData = $data["Info_Lomba"]["result"];
                // Dump::out($eventData);


                // Loop untuk menampilkan data event
                foreach ($eventData as $event) {
                    echo '<div class="event-box">';
                    echo '<div class="event-img">';
                    echo '<img src="' . $event['file_poster'] . '" alt="Event Image">';
                    echo '</div>';
                    echo '<div class="event-info">';
                    echo '<div class="date">' . $event['tanggal_akhir_pendaftaran'] . '</div>';
                    echo '<div class="event-name">' . $event['judul'] . '</div>';
                    echo '<div class="categories">';
                    echo '<ul>';
                    echo ($event['deskripsi_lomba']);
                    echo '</ul>';
                    echo '</div>';
                    echo '<div class="link"><a href="' . $event['link_perlombaan'] . '" target="_blank">Klik disini</a></div>';
                    echo '</div>'; // event-info
                    echo '</div>'; // event-box
                }
                ?>
            </div>
        </div>

    </div>
    <div class="leaderboard">
        <div class="header-container">
            <div class="header">LEADERBOARD</div>
        </div>
        <div class="rank-list">
            <?php
            // Data leaderboard dalam array 
            // Loop untuk menampilkan data leaderboard
            foreach ($leaderboardData as $item) {
                echo '<div class="rank-item">';
                echo '<div class="rank-number">' . $item['rank'] . '</div>';
                echo '<img src="./' . $item['Foto'] . '" alt="User Image">';
                echo '<div class="rank-info">';
                echo '<div class="name">' . $item['Nama_Mahasiswa'] . '</div>';
                echo '<div class="details">' . $item['Program_Studi'] . '</div>';
                echo '<div class="points">' . $item['Total_SKor'] . ' pts</div>';
                echo '</div>'; // rank-info
                echo '</div>'; // rank-item
            }
            ?>
        </div>


    </div>
</div>
</body>

</html>