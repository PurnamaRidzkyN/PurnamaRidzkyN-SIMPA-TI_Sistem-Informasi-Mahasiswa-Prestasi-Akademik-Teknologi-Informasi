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
        align-items: center;
        background-color: #0039C8;
        padding: 15px 30px;
        /* Reduced padding */
        color: white;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.2);
    }

    .navbar .logo {
        display: flex;
        align-items: center;
    }

    .navbar .logo img {
        height: 50px;
        /* Reduced logo size */
        margin-right: 10px;
    }

    .navbar .logo h1 {
        font-size: 24px;
        /* Reduced font size for title */
        margin: 0;
    }

    .navbar .menu a {
        color: white;
        text-decoration: none;
        margin: 0 15px;
        /* Reduced spacing */
        font-size: 18px;
        /* Reduced menu font size */
    }

    .navbar .menu a:hover {
        text-decoration: underline;
    }

    .container {
        max-width: 700px;
        /* Reduced max width */
        margin: 80px auto;
        /* Reduced margin top */
        text-align: center;
        background-color: #0039C8;
        padding: 30px;
        /* Reduced padding */
        border-radius: 15px;
        /* Slightly reduced border radius */
        box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.3);
    }

    .profile-pic {
        width: 200px;
        /* Reduced profile pic size */
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        border: 6px solid #AFFA08;
        /* Reduced border width */
        margin-bottom: 30px;
    }

    .profile-info h2,
    .profile-info p {
        color: white;
        margin: 10px 0;
        /* Reduced spacing */
    }

    .profile-info .name {
        background-color: #AFFA08;
        color: black;
        font-size: 28px;
        /* Reduced font size */
        font-weight: bold;
        padding: 12px 20px;
        /* Reduced padding */
        border-radius: 10px;
        /* Reduced border radius */
        display: inline-block;
    }

    .profile-info .score {
        font-size: 35px;
        /* Reduced font size */
        font-weight: bold;
        color: #AFFA08;
    }

    .profile-info p {
        font-size: 18px;
        /* Reduced font size for paragraphs */
    }
</style>

<?php

use app\cores\Session;
use app\cores\View;

$profil = View::getData();
$profil =$profil[0];

?>
<!-- Main Content -->
<div class="container">
    <img src="https://via.placeholder.com/200" alt="Foto Profil" class="profile-pic">
    <div class="profile-info">
        <h2 class="name"><?php echo $profil['nama'] ?></h2>
        <p>Prodi : <?php echo $profil['prodi'] ?></p>
        <p>Email : <?php echo $profil['Email'] ?></p>
        <p>NIM : <?php echo $profil['nim'] ?></p>
        <p class="score">Score: <?php echo $profil['total_skor'] ?></p>
    </div>
</div>