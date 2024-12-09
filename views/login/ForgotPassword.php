<body class="bg-primary d-flex align-items-center justify-content-center h-screen">
    <div class="bg-white rounded-4 px-5 py-4 shadow-lg text-center">
        <h1 class="fw-bold text-primary">Lupa Kata Sandi</h1>
        <p class="fs-5 mt-3 text-secondary">Masukkan email dan username Anda untuk mengatur ulang kata sandi</p>

        <form action="/send-password" method="post" class="mt-4">
            <!-- Username Input -->
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username Anda" required>
            </div>

            <!-- Email Input -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" required>
            </div>

            <!-- Pesan Error / Sukses -->
            <div class="text-danger mb-3">
                <?php echo app\cores\View::getData()["error"] ?? "" ?>
            </div>
            <div class="text-success mb-3">
                <?php echo app\cores\View::getData()["success"] ?? "" ?>
            </div>

            <!-- Tombol Kirim -->
            <button type="submit" class="btn btn-primary w-100 py-2">Kirim sandi baru</button>

            <!-- Kembali ke Login -->
            <div class="mt-3">
                <a href="/login" class="text-decoration-none text-primary">Kembali ke Login</a>
            </div>
        </form>
    </div>
</body>
