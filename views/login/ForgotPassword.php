<style>
    body {
        margin: 0;
        padding: 0;
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

    .header {
        text-align: center;
        margin: 20px 0;
    }

    .header h1 {
        font-size: 2rem;
        color: #0000EE;
        margin: 0;
    }

    .app-name-container {
        display: flex;
        flex-direction: column;
        align-items: center;
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
        max-width: 400px;
        margin: 20px auto;
    }

    .input-group {
        margin-bottom: 12px;
        display: flex;
        flex-direction: column;
    }

    .input-group label {
        font-size: 1rem;
        color: #0039C8;
        margin-bottom: 5px;
    }

    .input-group input {
        padding: 8px;
        font-size: 1rem;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .error-message {
        text-align: center;
        color: red;
        font-size: 0.9rem;
        margin-top: 10px;
    }

    .send-button {
        margin-top: 20px;
        background: #0000EE;
        color: white;
        border: none;
        padding: 12px;
        width: 100%;
        border-radius: 30px;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
    }

    .back-to-login {
        text-align: center;
        margin-top: 20px;
    }

    .back-to-login a {
        text-decoration: none;
        color: #0039C8;
        font-size: 1rem;
    }

    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        display: none;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid #ccc;
        border-top-color: #0039C8;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
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

    .login-button {
        font-size: 1.2rem;
    }
}
</style>

<div class="loading-overlay">
    <div class="spinner"></div>
</div>

<div class="container">
    <div class="left-section">
        <div class="app-name-container">
            <img class="logo" src="../public/component/logoHijau.png" alt="Logo">
            <div class="app-name">
                <span class="simpa">SIMPA</span><span class="dash">-</span><span class="ti">TI</span>
            </div>
        </div>
    </div>

    <div class="right-section">
        <div class="header">
            <h1>Lupa Kata Sandi</h1>
        </div>

        <form action="/send-password" method="post" class="forgot-password-form" id="forgotPasswordForm">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username">
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email">
            </div>

            <!-- Pesan Error -->
            <div class="error-message" id="error-message">
                <!-- PHP error message will be inserted here -->
                <?php echo app\cores\View::getData()["error"] ?? "" ?>
            </div>

            <button type="submit" class="send-button">Kirim Kata Sandi Baru</button>

            <!-- Kembali ke halaman login -->
            <div class="back-to-login">
                <a href="/login">Kembali ke halaman login</a>
            </div>
        </form>
    </div>
</div>

<!-- jQuery Library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fungsi untuk menampilkan overlay loading saat form dikirim
        $('#forgotPasswordForm').on('submit', function() {
            $('.loading-overlay').show();
        });
    });
</script>