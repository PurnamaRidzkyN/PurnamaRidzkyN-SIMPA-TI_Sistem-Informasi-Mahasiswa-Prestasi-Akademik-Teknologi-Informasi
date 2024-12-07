<?php

use app\cores\Session;

$user = Session::get('user');
?>
<h2>Log Data Perubahan</h2>

<!-- Formulir Filter untuk Mencari Data -->
<form action="<?php echo '../' . $user . '/log-data/search'; ?>" method="POST">
    <div>
        <label for="nama_user">Nama User: </label>
        <input 
            type="text" 
            id="nama_user" 
            name="nama_user" 
            placeholder="Cari Nama User">
    </div>
    <div>
        <label for="tabel_perubahan">Tabel Perubahan: </label>
        <input 
            type="text" 
            id="tabel_perubahan" 
            name="tabel_perubahan" 
            placeholder="Cari Tabel Perubahan">
    </div>
    <div>
        <label for="tanggal">Tanggal: </label>
        <input 
            type="date" 
            id="tanggal" 
            name="tanggal">
    </div>
    <div>
        <button type="submit">Cari</button>
    </div>
</form>

<!-- Tabel Hasil Pencarian -->
<table border="1">
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
            echo "<tr><td colspan='4'>Data log tidak ditemukan.</td></tr>";
        }
        ?>
    </tbody>
</table>
