<body class="bg-primary d-flex align-items-center justify-content-center h-screen">
    <div class="bg-white rounded-4 px-5 py-4 shadow-lg text-center">
        <h1 class="fw-bold text-primary">SIMPA-TI</h1>
        <p class="fs-4 mt-3">Silahkan Masuk</p>
        <p class="text-secondary">Masukkan username dan kata sandi Anda</p>

        <form action="/post-login" method="post" class="mt-4">
            <!-- Username -->
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi">
            </div>

            <!-- Checkbox untuk Tampilkan Password -->
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="viewPassword">
                <label class="form-check-label text-secondary" for="viewPassword">Tampilkan Kata Sandi</label>
            </div>

            <!-- Pesan Error -->
            <div class="text-danger mb-3">
                <?php echo app\cores\View::getData()["error"] ?? "" ?>
            </div>

            <!-- Tombol Masuk -->
            <button type="submit" class="btn btn-primary w-100 py-2">Masuk</button>

            <!-- Link Lupa Kata Sandi -->
            <div class="mt-3">
                <a href="/forgot-password" class="text-decoration-none text-primary">Lupa Kata Sandi?</a>
            </div>
        </form>
    </div>

    <!-- jQuery Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#viewPassword').on('change', function() {
                const passwordField = $('#password');
                const isChecked = $(this).is(':checked');
                passwordField.attr('type', isChecked ? 'text' : 'password');
            });
        });
    </script>
</body>
