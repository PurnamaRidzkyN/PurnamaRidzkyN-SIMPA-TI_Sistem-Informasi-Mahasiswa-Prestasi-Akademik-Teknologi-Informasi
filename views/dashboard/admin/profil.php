<style>
    body {
        margin: 0;
        font-family: 'Galatea', sans-serif;
        background-color: #f5f5f5;
        color: white;
    }

    .container {
        max-width: 700px;
        margin: 80px auto;
        text-align: center;
        background-color: #0039C8;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.3);
        position: relative; /* Set relative for absolute positioning inside */
    }

    .logout-button {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: #AFFA08;
        color: black;
        font-size: 12px;
        font-weight: bold;
        padding: 8px 14px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-transform: uppercase;
    }

    .logout-button:hover {
        background-color: #d4e806;
    }

    .profile-pic {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        border: 6px solid #AFFA08;
        margin-bottom: 30px;
    }

    .profile-info h2,
    .profile-info p {
        color: white;
        margin: 10px 0;
    }

    .profile-info .name {
        background-color: #AFFA08;
        color: black;
        font-size: 28px;
        font-weight: bold;
        padding: 12px 20px;
        border-radius: 10px;
        display: inline-block;
    }

    .profile-info .score {
        font-size: 35px;
        font-weight: bold;
        color: #AFFA08;
    }
	
	.change-password-button {
        position: static;
        margin-top: 15px;
		border-radius: 8px;
		cursor: pointer;
		padding: 8px 14px;
		font-weight: bold;
		font-size: 11px;
    }

    .profile-info p {
        font-size: 18px;
    }
</style>

<?php

use app\cores\Session;
use app\cores\View;

$profil = View::getData();
$profil = $profil[0];

?>
<!-- Main Content -->
<div class="container">
    <!-- Logout Button -->
    <button class="logout-button" onclick="window.location.href='/logout'">Logout</button>


    <img src=" <?php echo '../../../'.$profil['foto'] ?>" alt="Foto Profil" class="profile-pic">
    <div class="profile-info">
		
        <h2 class="name"><?php echo $profil['nama'] ?></h2>
        <p>Email : <?php echo $profil['Email'] ?></p>
        <p>NIP : <?php echo $profil['nim'] ?></p>
		<button class="change-password-button" onclick="window.location.href='/ganti-password'">Ganti Password</button>
    </div>
</div>
