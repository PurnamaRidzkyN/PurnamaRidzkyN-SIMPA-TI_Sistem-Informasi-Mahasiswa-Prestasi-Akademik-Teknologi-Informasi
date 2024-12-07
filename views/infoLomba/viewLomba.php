<h1>Daftar Lomba</h1>
<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>
<table>
    <thead>
        <tr>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Tanggal Akhir Pendaftaran</th>
            <th>Link</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($infoLomba as $lomba): ?>
            <tr>
                <td><?php echo $lomba["judul"]; ?></td>
                <td><?php echo $lomba["deskripsi_lomba"]; ?></td>
                <td><?php echo $lomba["tanggal_akhir_pendaftaran"]; ?></td>
                <td><a href="<?php echo $lomba["link_perlombaan"]; ?>">Link</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
