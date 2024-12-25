<?php

use app\cores\Session;
use app\cores\View;
use app\helpers\Dump;

$user = Session::get('user');
$data = View::getData();
$adminData = $data["data"];
$mahasiswaData = $data["mahasiswa"];
$logData = $data["log data"];
$dosenData = $data["dosen"];
$selectedData = $data["data"]["data"];
$manipulate = $data["data"]["edit"];

?>
<!data html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPA-TI</title>
    <style>
        body {
            font-family: Galatea, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        /* Konten Utama */
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 30px auto;
            position: relative;
        }

        .content-header {
            font-size: 24px;
            font-weight: 700;
            color: #0039C8;
            margin-bottom: 20px;
        }

        /* Management Data Section */
        .management-section {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .management-option {
            background-color: #0039C8;
            color: white;
            padding: 15px;
            border-radius: 10px;
            width: 200px;
            text-align: center;
            cursor: pointer;
        }

        .management-option:hover {
            background-color: #1e3c94;
        }

        /* Tabel Data */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            text-align: left;
        }

        th,
        td {
            padding: 10px;
            font-size: 16px;
        }

        th {
            background-color: #0039C8;
            color: white;
        }

        /* Form Add Data */
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
        }

        .form-container input,
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .form-container button {
            background-color: #0039C8;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            border: none;
        }

        .form-container button:hover {
            background-color: #1e3c94;
        }
    </style>
</head>

<body>
    <!-- Main Content -->
    <div class="container">
        <div class="content-header">
            Management Data
        </div>

        <!-- Menu untuk pilih jenis data -->
        <div class="management-section">
            <!-- Menu untuk pilih jenis data -->
            <div class="management-section">
                <!-- Form for Data Admin -->
                <form action=<?php echo "/dashboard/admin/" . $user . "/manajemen-data" ?> method="post" class="data-form">
                    <input type="hidden" name="data" value="admin">
                    <button data="submit" class="management-option" value="admin">Data Admin</button>
                </form>

                <!-- Form for Data Mahasiswa -->
                <form action=<?php echo "/dashboard/admin/" . $user . "/manajemen-data" ?> method="POST" class="data-form">
                    <input type="hidden" name="data" value="mahasiswa">
                    <button data="submit" class="management-option">Data Mahasiswa</button>
                </form>

                <!-- Form for Data Dosen -->
                <form action=<?php echo "/dashboard/admin/" . $user . "/manajemen-data" ?> method="POST" class="data-form">
                    <input type="hidden" name="data" value="dosen">
                    <button data="submit" class="management-option">Data Dosen</button>
                </form>

                <!-- Form for Data Info Lomba -->
                <form action=<?php echo "/dashboard/admin/" . $user . "/manajemen-data" ?> method="POST" class="data-form">
                    <input type="hidden" name="data" value="lomba">
                    <button data="submit" class="management-option">Data Info Lomba</button>
                </form>

                <!-- Form for Log Data -->
                <form action=<?php echo "/dashboard/admin/" . $user . "/manajemen-data" ?> method="POST" class="data-form">
                    <input type="hidden" name="data" value="log data">
                    <button data="submit" class="management-option">Log Data</button>
                </form>
            </div>

            <div id="data-container"></div>

        </div>

        <!-- Tabel dan Form untuk menambah data -->
        <div id="data-container" class="data-container"></div>
    </div>

    

    <?php if (!empty($selectedData) && isset($data[$selectedData])): ?>
    <h3>Data <?= formatTitle($selectedData) ?></h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <?php if (!empty($data[$selectedData])): ?>
                    <?php foreach (array_keys($data[$selectedData][0]) as $column): ?>
                        <th><?= formatTitle($column) ?></th>
                    <?php endforeach; ?>
                    <?php if ($selectedData !== 'log data'): ?>
                        <th>Aksi</th> <!-- Kolom tambahan untuk aksi jika bukan log data -->
                    <?php endif; ?>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data[$selectedData] as $index => $row): ?>
                <?php if ($selectedData === 'log data'): ?>
                    <!-- Jika log data, hanya tampilkan data tanpa aksi -->
                    <tr>
                        <?php foreach ($row as $keyField => $value): ?>
                            <td>
                                <?php if ($keyField === 'foto' && !empty($value)): ?>
                                    <img src="<?= htmlspecialchars($value) ?>" alt="<?= htmlspecialchars($selectedData) ?> Foto" width="40" height="40">
                                <?php else: ?>
                                    <?= htmlspecialchars($value) ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php else: ?>
                    <!-- Jika bukan log data -->
                    <?php if (isset($key) && $row['id'] === $key['id']): ?> 
                        <!-- Jika ID cocok, tampilkan form edit -->
                        <tr>
                            <form method="post" action="">
                                <?php foreach ($row as $keyField => $value): ?>
                                    <td>
                                        <?php if ($keyField === 'foto'): ?>
                                            <input type="file" name="<?= $keyField ?>" value="<?= htmlspecialchars($value) ?>">
                                        <?php else: ?>
                                            <input type="text" name="<?= $keyField ?>" value="<?= htmlspecialchars($value) ?>">
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                                <td>
                                    <button type="submit" name="save" value="<?= $row['id'] ?>">Save</button>
                                    <button type="submit" name="cancel" value="<?= $row['id'] ?>">Cancel</button>
                                </td>
                            </form>
                        </tr>
                    <?php else: ?>
                        <!-- Jika ID tidak cocok, tampilkan data biasa -->
                        <tr>
                            <?php foreach ($row as $keyField => $value): ?>
                                <td>
                                    <?php if ($keyField === 'foto' && !empty($value)): ?>
                                        <img src="../../../<?= htmlspecialchars($value) ?>" alt="<?= htmlspecialchars($selectedData) ?> Foto" width="40" height="40">
                                    <?php else: ?>
                                        <?= htmlspecialchars($value) ?>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                            <td>
                                <form method="post" action="/dashboard/admin/<?= htmlspecialchars($user) ?>/manajemen-data">
                                    <input type="hidden" name="data" value="<?= $selectedData ?>">
                                    <button type="submit" name="edit" value="<?= $row['id'] ?>">Edit</button>
                                    <button type="submit" name="delete" value="<?= $row['id'] ?>">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
        
    </table>
    <form method="post" action="/dashboard/admin/<?= htmlspecialchars($user) ?>/manajemen-data">
                                    <input type="hidden" name="data" value="<?= $selectedData ?>">
                                    <button type="submit" name="edit" value="add">Tambah data</button>
                                </form>
<?php endif; ?>

<?php if (!empty($manipulate)): ?>
    <h3><?= $manipulate === 'add' ? 'Tambah Data' : 'Edit Data' ?> <?= formatTitle($selectedData) ?></h3>
    <form method="post" action="/dashboard/admin/<?= htmlspecialchars($user) ?>/manajemen-data/manipulate-data" enctype="multipart/form-data">
        <table border="0" cellpadding="5" cellspacing="0">
            <?php 
            // Jika manipulate adalah 'add', buat array kosong sesuai dengan kolom yang ada
            $currentData = ($manipulate === 'add') 
                ? array_fill_keys(array_keys($data[$selectedData][0]), '') // Data kosong untuk tambah
                : array_filter($data[$selectedData], function ($row) use ($manipulate) {
                    return $row['id'] === $manipulate; // Cari data berdasarkan ID yang ada di variabel manipulate
                });

            // Ambil data pertama dari array yang sudah difilter (hanya ada satu data yang cocok)
            $currentData = reset($currentData); // Mengambil data pertama dari hasil filter, bisa kosong jika tambah data

            // Pastikan $currentData bukan kosong untuk menghindari error
            if (!$currentData) {
                $currentData = array_fill_keys(array_keys($data[$selectedData][0]), ''); // Jika data kosong, buat array kosong
            }

            // Mahasiswa
            else if (type === 'mahasiswa') {
                dataHTML = `
                    <h3>Data Mahasiswa</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>NIM</th>
                                <th>Profil</th>
                                <th>Tanggal Lahir</th>
                                <th>Prodi</th>
                                <th>Total Skor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mahasiswa A</td>
                                <td>mahasiswaA@domain.com</td>
                                <td>123456789</td>
                                <td><img src="profileA.jpg" alt="Profil" width="40" height="40"></td>
                                <td>1999-01-01</td>
                                <td>TI</td>
                                <td>100</td>
                            </tr>
                        </tbody>
                    </table>
                    <h4>Tambah Data Mahasiswa Baru</h4>
                    <div class="form-container">
                        <input type="text" placeholder="ID Mahasiswa" id="mahasiswa-id">
                        <input type="text" placeholder="Nama Mahasiswa" id="mahasiswa-name">
                        <input type="email" placeholder="Email Mahasiswa" id="mahasiswa-email">
                        <input type="text" placeholder="NIM" id="mahasiswa-nim">
                        <input type="date" placeholder="Tanggal Lahir" id="mahasiswa-tanggal-lahir">
                        <input type="text" placeholder="Prodi" id="mahasiswa-prodi">
                        <input type="number" placeholder="Total Skor" id="mahasiswa-total-skor">
                        <input type="file" id="mahasiswa-profile">
                        <button onclick="addData('mahasiswa')">Tambah Data</button>
                    </div>
                `;
            }

            // Dosen
            else if (type === 'dosen') {
                dataHTML = `
                    <h3>Data Dosen</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Email</th>
                                <th>Profil</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Dosen A</td>
                                <td>123456</td>
                                <td>dosenA@domain.com</td>
                                <td><img src="profileD.jpg" alt="Profil" width="40" height="40"></td>
                            </tr>
                        </tbody>
                    </table>
                    <h4>Tambah Data Dosen Baru</h4>
                    <div class="form-container">
                        <input type="text" placeholder="ID Dosen" id="dosen-id">
                        <input type="text" placeholder="Nama Dosen" id="dosen-name">
                        <input type="email" placeholder="Email Dosen" id="dosen-email">
                        <input type="text" placeholder="NIP" id="dosen-nip">
                        <input type="file" id="dosen-profile">
                        <button onclick="addData('dosen')">Tambah Data</button>
                    </div>
                `;
            }

            // Info Lomba
            else if (type === 'lomba') {
                dataHTML = `
                    <h3>Info Lomba</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Akhir Pendaftaran</th>
                                <th>Link</th>
                                <th>File Poster</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Lomba A</td>
                                <td>Deskripsi Lomba A</td>
                                <td>2024-12-31</td>
                                <td><a href="linkLombaA.com">Link</a></td>
                                <td><img src="posterA.jpg" alt="Poster" width="40" height="40"></td>
                            </tr>
                        </tbody>
                    </table>
                    <h4>Tambah Info Lomba Baru</h4>
                    <div class="form-container">
                        <input type="text" placeholder="ID Lomba" id="lomba-id">
                        <input type="text" placeholder="Judul Lomba" id="lomba-judul">
                        <textarea placeholder="Deskripsi Lomba" id="lomba-deskripsi"></textarea>
                        <input type="date" placeholder="Tanggal Akhir Pendaftaran" id="lomba-tanggal-akhir">
                        <input type="url" placeholder="Link Pendaftaran" id="lomba-link">
                        <input type="file" id="lomba-poster">
                        <button onclick="addData('lomba')">Tambah Info Lomba</button>
                    </div>
                `;
            }

            // Log Data
            else if (type === 'log') {
                dataHTML = `
                    <h3>Log Data</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID User</th>
                                <th>ID Perubahan</th>
                                <th>Tabel Perubahan</th>
                                <th>Keterangan Kegiatan</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>1001</td>
                                <td>2001</td>
                                <td>admin</td>
                                <td>Update data admin</td>
                                <td>2024-12-08</td>
                            </tr>
                        </tbody>
                    </table>
                `;
            }

            dataContainer.innerHTML = dataHTML;
        }

        // Fungsi untuk menambah data
        function addData(type) {
            let data = {};
            if (type === 'admin') {
                data.id = document.getElementById('admin-id').value;
                data.email = document.getElementById('admin-email').value;
                data.name = document.getElementById('admin-name').value;
                data.nip = document.getElementById('admin-nip').value;
            } else if (type === 'mahasiswa') {
                data.id = document.getElementById('mahasiswa-id').value;
                data.name = document.getElementById('mahasiswa-name').value;
                data.nim = document.getElementById('mahasiswa-nim').value;
                data.tanggal_lahir = document.getElementById('mahasiswa-tanggal-lahir').value;
                data.prodi = document.getElementById('mahasiswa-prodi').value;
                data.total_skor = document.getElementById('mahasiswa-total-skor').value;
            } else if (type === 'dosen') {
                data.id = document.getElementById('dosen-id').value;
                data.name = document.getElementById('dosen-name').value;
                data.nip = document.getElementById('dosen-nip').value;
                data.email = document.getElementById('dosen-email').value;
            } else if (type === 'lomba') {
                data.id = document.getElementById('lomba-id').value;
                data.judul = document.getElementById('lomba-judul').value;
                data.deskripsi = document.getElementById('lomba-deskripsi').value;
                data.tanggal_akhir = document.getElementById('lomba-tanggal-akhir').value;
                data.link = document.getElementById('lomba-link').value;
            } else if (type === 'log') {
                data.id_user = document.getElementById('log-id-user').value;
                data.id_perubahan = document.getElementById('log-id-perubahan').value;
                data.tabel_perubahan = document.getElementById('log-tabel-perubahan').value;
                data.keterangan_kegiatan = document.getElementById('log-keterangan').value;
                data.tanggal = document.getElementById('log-tanggal').value;
            }
            console.log(data); // Data yang dimasukkan akan ditampilkan di konsol
            alert(type + " data has been added!");
        }
    </script>

</body>

</html>