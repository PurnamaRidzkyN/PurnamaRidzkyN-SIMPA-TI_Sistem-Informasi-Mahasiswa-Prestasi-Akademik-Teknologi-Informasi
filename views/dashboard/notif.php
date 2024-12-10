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

        .navbar .menu a:hover {
            color: #AFFA08;
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
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar" id="navbar">
    <div class="logo">
        <img src="logoHijau.png" alt="Logo">
        <div>
            <h1>SIMPA-TI</h1>
        </div>
    </div>
    <div class="menu" id="menu">
        <!-- Menu items will be dynamically updated here -->
    </div>
    <div class="user-info">
        <div class="notifications" onclick="window.location.href='notifikasi.html'">
            <img src="notifikasi-03.png" alt="Notifikasi">
        </div>
        <img src="profilpic.png" alt="Profile">
    </div>
</div>

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
    <div class="bubble-notification unread" onclick="markAsRead(this)">
        <div style="display: flex; align-items: center;">
            <img src="notifikasi-03.png" alt="Icon Notifikasi">
            <span>
                Data Kompetisi INTERCOMP UI/UX Competition Anda telah di validasi oleh admin.
            </span>
        </div>
        <div class="delete-notification" onclick="deleteNotification(event, this)">Hapus</div>
    </div>

    <div class="bubble-notification unread" onclick="markAsRead(this)">
        <div style="display: flex; align-items: center;">
            <img src="notifikasi-03.png" alt="Icon Notifikasi">
            <span>
                Pemberitahuan lainnya tentang kompetisi UI/UX tersedia di dashboard Anda.
            </span>
        </div>
        <div class="delete-notification" onclick="deleteNotification(event, this)">Hapus</div>
    </div>
</div>

<script>
    // Variabel role untuk menentukan peran pengguna (mahasiswa atau admin)
    var role = 'admin'; // Gantilah sesuai dengan peran yang sesungguhnya

    // Function to dynamically populate the menu based on user role
    function updateNavbarMenu() {
        var menuContainer = document.getElementById('menu');
        
        // Menu untuk admin
        if (role === 'admin') {
            menuContainer.innerHTML = `
                <a href="#">Home</a>
                <a href="#">Prestasi</a>
                <a href="#">Leaderboard</a>
                <a href="#">Management Data</a>
            `;
        } else {
            // Menu untuk mahasiswa
            menuContainer.innerHTML = `
                <a href="#">Home</a>
                <a href="#">Prestasi</a>
                <a href="#">Leaderboard</a>
            `;
        }
    }

    // Call the function to update navbar menu when the page loads
    updateNavbarMenu();

    // Function to mark notification as read or unread
    function markAsRead(notification) {
        if (notification.classList.contains('unread')) {
            notification.classList.remove('unread');
            notification.classList.add('read');
        }
    }

    // Function to delete the notification
    function deleteNotification(event, notificationElement) {
        // Prevent the click event from propagating to the parent
        event.stopPropagation();

        // Admin dapat menghapus notifikasi
        if (role === 'admin') {
            notificationElement.closest('.bubble-notification').remove();
        } else {
            alert("Anda tidak memiliki izin untuk menghapus notifikasi.");
        }
    }
</script>

</body>
</html>
