<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPA-TI</title>
    <style>
        body {
            font-family: Galatea, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        /* Main Container Styling */
        .container {
            padding: 0px;
            max-width: 800px;
            margin: 30px auto;
            position: relative;
        }

        .header {
            margin-top: 20px;
            padding: 10px;
            display: flex;
            flex-direction: row;
            gap: 10px;
            align-items: center;
        }

        .header .home {
            font-size: 24px;
            font-weight: 700;
            color: black;
            font-family: 'Galatea', sans-serif;
        }

        .header .date {
            font-size: 18px;
            font-weight: 400;
            color: rgba(0, 0, 0, 0.70);
            font-family: 'Galatea', sans-serif;
        }

        /* Bubble Notifikasi Styling */
        .bubble-notification {
            background: #0039C8;
            color: white;
            border-radius: 20px;
            padding: 20px 30px;
            margin-bottom: 30px;
            position: relative;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
            font-size: 20px;
            font-weight: 500;
            transition: background-color 0.3s ease-in-out;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .bubble-notification.read {
            background-color: #D3D3D3;
        }

        .bubble-notification.unread {
            background-color: #0039C8;
        }

        .bubble-notification .delete-notification {
            align-self: flex-end;
            font-size: 16px;
            font-weight: 500;
            color: red;
            cursor: pointer;
            margin-top: 10px;
        }

        .bubble-notification .delete-notification:hover {
            text-decoration: underline;
        }

        /* Notification Icon (if needed) */
        .bubble-notification img {
            width: 25px;
            height: 25px;
            margin-right: 15px;
        }

        .info {
            font-size: 14px;
            color: #D3D3D3;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <!-- Konten Header -->
    <div class="header">
        <div class="home">HOME</div>
        <div class="date">
            <?php
            date_default_timezone_set('Asia/Jakarta');
            echo date('d F Y');
            ?>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <?php
        // Simulasi array notifikasi
        $notifikasi = [
            [
                'pesan' => 'Data Kompetisi INTERCOMP UI/UX Competition Anda telah divalidasi oleh admin.',
                'tipe' => 'Validasi',
                'status' => 'Belum dilihat',
                'dibuat' => '2024-12-28 14:30:00',
            ],
            [
                'pesan' => 'Pemberitahuan lainnya tentang kompetisi UI/UX tersedia di dashboard Anda.',
                'tipe' => 'Informasi',
                'status' => ' dilihat',
                'dibuat' => '2024-12-27 10:00:00',
            ],
        ];

        // Loop untuk menampilkan notifikasi
        foreach ($notifikasi as $notif) {

            echo "
       <div class='bubble-notification $statusClass'>
        <a href='$linkDetail' style='text-decoration: none; color: inherit;'> <!-- Link Detail -->
            <div style='display: flex; align-items: center;'>
                <img src='../../../public/component/notifikasi-03.png' alt='Icon Notifikasi'>
                <span>{$notif['pesan']}</span>
            </div>
            <div class='info'>
                <strong>Tipe:</strong> {$notif['tipe']} | 
                <strong>Status:</strong> {$notif['status']} | 
                <strong>Dibuat:</strong> {$notif['dibuat']}
            </div>
        </a>
        
        <!-- Tombol Hapus -->
        <form method='POST' action='delete_notification.php' style='margin-top: 10px;'>
            <input type='hidden' name='id' value='{$notif['dibuat']}'> <!-- Kirim ID notifikasi untuk dihapus -->
            <button type='submit' class='delete-notification'>Hapus</button>
        </form>
    </div>
        ";
        }
        ?>
    </div>

</body>

</html>