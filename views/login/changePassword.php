<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Ubah Kata Sandi</h4>
                    </div>
                    <div class="card-body">
                        <!-- Formulir untuk ubah kata sandi -->
                        <form action="/change-password/new-password" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Kata Sandi Lama</label>
                                <input type="password" class="form-control" id="old_password" name="old_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Kata Sandi Baru</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_new_password" class="form-label">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Ubah Kata Sandi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mengimpor Bootstrap JS dan dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-T4fFvkt8UJj9dOBht85jUtM6B9eTZ5NplX08ew6fOjaMXjwIdt6kkK4PbggbST/e" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0gG4Hk2meVZrjVnoffBlms3XM8M0abvduR4t6vVStwz+bdc" crossorigin="anonymous"></script>
</body>