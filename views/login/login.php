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

.login-form {
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

.forgot-password {
    text-align: right;
    margin-top: 8px;
}

.forgot-password a {
    text-decoration: none;
    color: rgba(0, 0, 238, 0.5);
    font-size: 0.9rem;
}

.login-button {
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

.system-description {
    text-align: center;
    font-size: 0.9rem;
    color: #0039C8;
    margin-top: 20px;
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
        <p class="system-description">
            SISTEM INFORMASI MAHASISWA BERPRESTASI TEKNOLOGI INFORMASI
        </p>
    </div>

    <div class="right-section">
        <div class="header">
            <h1>LOGIN</h1>
        </div>
        <form action="/post-login" method="post" class="login-form" id="loginForm">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password">
            </div>
            
            <!-- Checkbox untuk Tampilkan Password -->
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="viewPassword">
                <label class="form-check-label" for="viewPassword">Tampilkan kata sandi</label>
            </div>

            <!-- Pesan Error -->
            <div class="text-danger mb-3" id="error-message">
                <!-- PHP error message will be inserted here -->
                <?php echo app\cores\View::getData()["error"] ?? "" ?>
            </div>

            <button type="submit" class="login-button">LOGIN</button>
            
            <!-- Link Lupa Kata Sandi -->
            <div class="forgot-password">
                <a href="/forgot-password">*Lupa kata sandi?</a>
            </div>
        </form>
    </div>
</div>

<!-- jQuery Library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fungsi untuk mengubah jenis input password menjadi teks
        $('#viewPassword').on('change', function() {
            const passwordField = $('#password');
            const isChecked = $(this).is(':checked');
            passwordField.attr('type', isChecked ? 'text' : 'password');
        });
    });
</script>
