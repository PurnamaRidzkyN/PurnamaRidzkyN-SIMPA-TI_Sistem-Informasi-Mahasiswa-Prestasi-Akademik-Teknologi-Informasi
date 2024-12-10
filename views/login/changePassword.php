<title>SIMPA-TI</title>
<style>
    body {
        font-family: Galatea, sans-serif;
        margin: 0;
        padding: 0;
    }


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

    .container {
        padding: 0px;
        max-width: 800px;
        margin: 20px auto;
      
    }

    .container .form-container {
        background-color: #0039C8;
        padding: 30px;
        padding-bottom: 60px;
        border-radius: 15px;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    }

    .container .form-container h3 {
        color: #AFFA08;
        font-size: 28px;
        font-weight: 700;
    }

    .container .form-container label {
        color: rgba(255, 255, 255, 0.90);
        font-size: 20px;
        font-weight: 400;
    }

    .container .form-container input {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 16px;
        border-radius: 25px;
        border: none;
        font-size: 16px;
    }

    .container .form-container .submit-btn {
        background-color: #AFFA08;
        border-radius: 25px;
        padding: 10px 20px;
        color: black;
        font-size: 20px;
        font-weight: 500;
        text-align: center;
        cursor: pointer;
        border: none;
        width: 100%;
    }
</style>



<!-- Navbar -->
<div class="navbar">
    <div class="logo">
        <img src="./public/component/logoHijau.png" alt="Logo">
        <h1>SIMPA-TI</h1>
    </div>
    <div class="menu">
        <a href="#">Home</a>
        <a href="#">Prestasi</a>
        <a href="#">Leaderboard</a>
    </div>
    <div class="user-info">
        <div class="notifications" onclick="window.location.href='notifikasi.html'">
            <img src="./public/component/notifikasi.png" alt="Notifikasi">
        </div>
        <img src="./public/component/690622.jpg" alt="Profile">
    </div>
</div>

<!-- Main Content -->
<div class="container">
    <!-- Password Change Form -->
    <div class="form-container">
        <h3>Ganti Password</h3>
        <form action="/change-password/new-password" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email" required>

            <label for="old_password">Kata Sandi Lama</label>
            <input type="password" id="old_password" name="old_password" placeholder="Masukkan kata sandi lama" required>

            <label for="new_password">Kata Sandi Baru</label>
            <input type="password" id="new_password" name="new_password" placeholder="Masukkan kata sandi baru" required>

            <label for="confirm_new_password">Konfirmasi Kata Sandi Baru</label>
            <input type="password" id="confirm_new_password" name="confirm_new_password" placeholder="Konfirmasi kata sandi baru" required>

            <button type="submit" class="submit-btn">Ubah Kata Sandi</button>
        </form>
    </div>
</div>


<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>