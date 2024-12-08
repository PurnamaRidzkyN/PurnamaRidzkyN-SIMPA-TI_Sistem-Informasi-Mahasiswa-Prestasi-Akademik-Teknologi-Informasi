<?php

use app\cores\Session;

$user = Session::get('user');
?>


<div class="container">
    <header class="text-center mb-4">
        <h2>Log Data Perubahan</h2>
    </header>

    <!-- Formulir Filter untuk Mencari Data -->
    <form action="<?php echo '../' . $user . '/log-data'; ?>" method="post" onsubmit="return validateForm()">
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="nama_user" class="form-label">Nama User: </label>
                <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Cari Nama User">
            </div>
            <div class="col-md-4">
                <label for="tabel_perubahan" class="form-label">Tabel Perubahan: </label>
                <input type="text" class="form-control" id="tabel_perubahan" name="tabel_perubahan" placeholder="Cari Tabel Perubahan">
            </div>
            <div class="col-md-4">
                <label for="tanggal" class="form-label">Tanggal: </label>
                <input type="date" class="form-control" id="tanggal" name="tanggal">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <script>
        function validateForm() {
            const namaUser = document.getElementById('nama_user').value.trim();
            const tabelPerubahan = document.getElementById('tabel_perubahan').value.trim();
            const tanggal = document.getElementById('tanggal').value.trim();

            if (!namaUser && !tabelPerubahan && !tanggal) {
                alert('Harap isi minimal salah satu kolom pencarian.');
                return false; // Mencegah pengiriman form
            }
            return true; // Mengizinkan pengiriman form
        }
    </script>


    <!-- Tabel Hasil Pencarian -->
    <div class="table-responsive">
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Nama User</th>
                    <th>Tabel Perubahan</th>
                    <th>Deskripsi Perubahan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php

                use app\controllers\AuditLog;
                use app\cores\View;
                use app\helpers\Dump;


                $logData = View::getData();
                if (isset($logData['result']) && !empty($logData['result'])) {
                    $data = $logData['result']; // Ambil data dari ['result']
                    foreach ($data as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nama_user']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tabel_perubahan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['keterangan_kegiatan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Data log tidak ditemukan.</td></tr>";
                }

                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Memuat Bootstrap JS dan dependensinya -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>