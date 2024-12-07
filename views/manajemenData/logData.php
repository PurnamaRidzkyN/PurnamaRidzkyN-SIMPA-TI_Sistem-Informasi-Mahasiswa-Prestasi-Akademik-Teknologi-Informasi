<?php

use app\cores\Session;

$user = Session::get('user');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Data Perubahan</title>
    <!-- Memuat Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        table th, table td {
            text-align: center;
        }
        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <header class="text-center mb-4">
            <h2>Log Data Perubahan</h2>
        </header>

        <!-- Formulir Filter untuk Mencari Data -->
        <form action="<?php echo '../' . $user . '/log-data/search'; ?>" method="POST">
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

                    $logData = new AuditLog;
                    $logData = $logData->displayLogData();
                    if (isset($logData[0]['result']) && !empty($logData[0]['result'])) {
                        $data = $logData[0]['result']; // Ambil data dari ['result']
                        foreach ($data as $row) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nama_user']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['tabel_perubahan']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['keterangan_kegiatan']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // Jika data kosong, tampilkan pesan di tabel
                        echo "<tr><td colspan='4' class='text-center'>Data log tidak ditemukan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Memuat Bootstrap JS dan dependensinya -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
