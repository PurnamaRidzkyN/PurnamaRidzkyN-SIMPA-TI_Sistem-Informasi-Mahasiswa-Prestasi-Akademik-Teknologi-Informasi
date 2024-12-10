<style>
    body {
        background: linear-gradient(180deg, #0039C8 0%, #001C62 100%);
        font-family: Poppins, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        width: 90%;
        max-width: 900px;
        background: white;
        border-radius: 30px;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }

    .header h1 {
        font-size: 2rem;
        color: #0000EE;
        margin: 0;
    }

    .logo {
        width: 250px;
        height: auto;
        margin-bottom: 10px;
    }

    .app-name {
        font-size: 2.5rem;
        font-weight: bold;
        text-align: center;
    }

    .app-name .simpa {
        color: #0039C8;
    }

    .app-name .dash {
        color: #AFFA08;
    }

    .app-name .ti {
        color: #0039C8;
    }

    .forgot-password-form {
        width: 100%;
        max-width: 350px;
        margin: 10px auto;
    }

    .input-group {
        margin-bottom: 10px;
        font-weight: 700;
        display: flex;
        flex-direction: column;
    }

    .input-group label {
        font-size: 0.9rem;
        color: #0039C8;
        margin-bottom: 5px;
    }

    .input-group input {
        padding: 8px;
        font-size: 0.9rem;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .forgot-password-form p {
        font-size: 0.9rem;
        color: #0039C8;
        margin-bottom: 15px;
    }

    .back-to-login {
        text-align: center;
        margin-top: 10px;
    }

    .back-to-login a {
        text-decoration: none;
        color: #0000EE;
        font-size: 0.9rem;
    }

    .submit-button {
        margin-top: 15px;
        background: #0000EE;
        color: white;
        border: none;
        padding: 10px;
        width: 100%;
        border-radius: 30px;
        font-size: 0.9rem;
        font-weight: bold;
        cursor: pointer;
    }

    .submit-button:hover {
        background: #0039C8;
    }

    .system-description {
        text-align: center;
        font-size: 0.8rem;
        color: #0039C8;
        margin-top: 15px;
    }

    @media (min-width: 768px) {
        .container {
            flex-direction: row;
            justify-content: space-between;
            padding: 40px;
        }

        .left-section,
        .right-section {
            width: 45%;
        }

        .header h1 {
            font-size: 2.5rem;
        }

        .app-name {
            font-size: 3rem;
        }

        .system-description {
            font-size: 1rem;
        }

        .submit-button {
            font-size: 1.2rem;
        }
    }
</style>

<div class="container">
        <div class="left-section">
            <div class="app-name-container">
                <img class="logo" src="./public/component/logoHijau.png" alt="Logo">
                <div class="app-name">
                    <span class="simpa">SIMPA</span><span class="dash">-</span><span class="ti">TI</span>
                </div>
            </div>
            <p class="system-description">
                SISTEM INFORMASI MAHASISWA BERPRESTASI TEKNOLOGI INFORMASI
            </p>
        </div>

        <div class="right-section">
            <div class="header">
                <h1>LUPA KATA SANDI</h1>
            </div>
            <form action="/send-password" method="post" class="forgotPasswordForm" id="forgotPasswordForm">

                <div class="input-group">
                    <label for="username">Username</label>
                    <input class="username" type="text" id="username" placeholder="Masukkan Username Anda" required>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input class="email" type="email" id="email" placeholder="Masukkan Email Anda" required>
                </div>
                <!-- Pesan Error / Sukses -->
                <div class="text-danger mb-3">
                    <?php echo app\cores\View::getData()["error"] ?? "" ?>
                </div>
                <div class="text-success mb-3">
                    <?php echo app\cores\View::getData()["success"] ?? "" ?>
                </div>

                <button type="submit" class="submit-button">Kirim Sandi Baru</button>
            </form>

            <div class="back-to-login">
                <a href="/login">Kembali untuk Login</a>
            </div>
        </div>
    </div>


