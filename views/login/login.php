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
