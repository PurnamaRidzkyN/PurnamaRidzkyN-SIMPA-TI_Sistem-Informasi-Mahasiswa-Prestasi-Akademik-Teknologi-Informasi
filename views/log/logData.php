
<h2>Log Data Perubahan</h2>

<table border="1">
    <thead>
        <tr>
            <th>ID Log</th>
            <th>ID User</th>
            <th>ID Perubahan</th>
            <th>Tabel Perubahan</th>
            <th>Deskripsi Perubahan</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php use app\controllers\AuditLogController; ?>
        <?php
        $audit = new AuditLogController();
        $logData = $audit->logData();
        $data=$logData['result'];
        foreach ($data as $row) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['id_user'] . "</td>";
            echo "<td>" . $row['id_perubahan'] . "</td>";
            echo "<td>" . $row['tabel_perubahan'] . "</td>";
            echo "<td>" . $row['keterangan_kegiatan'] . "</td>";
            echo "<td>" . $row['tanggal'] . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
