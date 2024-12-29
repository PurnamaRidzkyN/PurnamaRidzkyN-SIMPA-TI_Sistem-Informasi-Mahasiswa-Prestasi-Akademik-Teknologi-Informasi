<?php

use app\cores\Session;
use app\cores\View;
use app\helpers\Dump;

$user = Session::get('user');
$data = View::getData();
$adminData = $data["data"];
$mahasiswaData = $data["mahasiswa"];
$logData = $data["log_data"];
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
    padding: 5px;
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
    flex-wrap: wrap;
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
    flex: 1 1 200px; /* Responsive flexbox */
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

table, th, td {
    border: 1px solid #ddd;
    text-align: left;
}

th, td {
    padding: 10px;
    font-size: 16px;
}

th {
    background-color: #0039C8;
    color: white;
    text-align: center;

}

/* Form styles */
.form-container {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
    margin-top: 20px;
}

.form-container input[type="text"],
.form-container input[type="file"],
.form-container textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 16px;
    transition: border-color 0.2s ease;
}

.form-container input[type="text"]:focus,
.form-container input[type="file"]:focus,
.form-container textarea:focus {
    outline: none;
    border-color: #0039C8;
    box-shadow: 0 0 0 3px rgba(0, 57, 200, 0.1);
}

<<<<<<< HEAD
            <!-- Menu untuk pilih jenis data -->
            <div class="management-section">
                <!-- Menu untuk pilih jenis data -->
                <div class="management-section">
                    <!-- Form for Data Admin -->
                    <form action=<?php echo "/dashboard/admin/manajemenData/adminData" . $user . "/manajemen-data" ?> method="POST" class="data-form">
                        <input type="hidden" name="data" value="admin">
                        <button data="submit" class="management-option" value="admin">Data Admin</button>
                    </form>

                    <!-- Form for Data Mahasiswa -->
                    <form action=<?php echo "/dashboard/admin/manajemenData/mahasiswaData" . $user . "/manajemen-data" ?> method="POST" class="data-form">
                        <input type="hidden" name="data" value="mahasiswa">
                        <button data="submit" class="management-option">Data Mahasiswa</button>
                    </form>

                    <!-- Form for Data Dosen -->
                    <form action=<?php echo "/dashboard/admin/manajemenData/dosenData" . $user . "/manajemen-data" ?> method="POST" class="data-form">
                        <input type="hidden" name="data" value="dosen">
                        <button data="submit" class="management-option">Data Dosen</button>
                    </form>
=======
.form-container small {
    display: block;
    margin-top: -10px;
    margin-bottom: 15px;
    color: gray;
    font-size: 14px;
}
td.actions {
    display: flex;
    justify-content: center; 
    align-items: center; 
    gap: 0.5rem; 
    padding: 10px; 
    box-sizing: border-box; 
    white-space: nowrap; 
    overflow: hidden; 
    height: 100%; 
}
/* Button styles */
button {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
    font-size: 0.95rem;
    margin: 0;
}

button[type="submit"] {
    background-color: #0039C8;
    color: white;
    margin-right: 0.5rem;
}

button[type="submit"]:hover {
    background-color: #002c9d;
}
>>>>>>> 0e03f35613f1392e43e5bcbd8e353e3a522350c2

button[name="cancel"] {
    background-color: #e5e7eb;
    color: #4b5563;
}

<<<<<<< HEAD
                    <!-- Form for Log Data -->
                    <form action=<?php echo "/dashboard/admin/manajemenData/logData" . $user . "/manajemen-data" ?> method="POST" class="data-form">
                        <input type="hidden" name="data" value="log_data">
                        <button data="submit" class="management-option">Log Data</button>
                    </form>
                </div>
=======
button[name="cancel"]:hover {
    background-color: #d1d5db;
}
>>>>>>> 0e03f35613f1392e43e5bcbd8e353e3a522350c2

button[name="edit"] {
    background-color: #0039C8;
    color: white;
    
}

button[name="edit"]:hover {
    background-color: #002c9d;
}

button[name="delete"] {
    background-color: #dc2626;
    color: white;
}

button[name="delete"]:hover {
    background-color: #b91c1c;
}

/* Add data button */
button[value="add"] {
    margin-top: 1rem;
    background-color: #059669;
    color: white;
}

button[value="add"]:hover {
    background-color: #047857;
}

.table-wrapper {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 3px 4px 10px rgba(0, 0, 0, 0.1); 
    margin-bottom: 20px;
    
}

/* Judul di dalam kotak */
.table-wrapper h3 {
    margin: 0 0 20px;
    font-size: 20px;
    color: #0039C8;
    border-bottom: 2px solid #0039C8;
    padding-bottom: 10px;
}

th, td {
    overflow: hidden;
    text-overflow: ellipsis;
    border: 1px solid #ddd;
    vertical-align: middle;
}
small {
    display: block;
    margin-top: 5px;
    color: #666;
    font-size: 12px;
}
/* Responsive adjustments */
@media (max-width: 768px) {
    .container {
        padding: 1rem;
        margin: 10px;
    }
    
    .management-section {
        flex-direction: column;
    }
    
    table {
        display: block;
        overflow-x: auto;
    }
    
    th, td {
        padding: 0.75rem;
    }
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
        <div class="table-wrapper"> <!-- Tambahkan div pembungkus di sini -->
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
    <td class="actions">
        <form method="post" action="/dashboard/admin/<?= htmlspecialchars($user) ?>/manajemen-data">
            <input type="hidden" name="data" value="<?= $selectedData ?>">
            <button type="submit" name="edit" value="<?= $row['id'] ?>">Edit</button>
            <button type="submit" name="delete" value="<?= $row['id'] ?>">Delete</button>
        </form>
    </td>

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

            foreach (array_keys($currentData) as $keyField): ?>
            <tr>
  <td><strong><?= formatTitle($keyField) ?></strong></td>
                    <td>
                        <?php if ($keyField === 'foto'): ?>
                            <input type="file" name="<?= $keyField ?>"accept="image/*">
                            <small>Format: JPG, PNG. Maksimal 2MB.</small>
                            <?php if ($manipulate !== 'add'): ?>
                                <p>Current: <?= htmlspecialchars($currentData[$keyField]) ?></p>
                            <?php endif; ?>
                        <?php else: ?>
                            <input type="text" name="<?= $keyField ?>" value="<?= htmlspecialchars($currentData[$keyField]) ?>">
                        <?php endif; ?>
                        <input type="hidden" name="data" value="<?= $selectedData ?>">
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit" name="save" value="<?= $manipulate === 'add' ? 'submit' : $currentData['id'] ?>">
                        <?= $manipulate === 'add' ? 'Submit' : 'Save' ?>
                    </button>
                    <input type="hidden" name="action" value="<?= $manipulate === 'add' ? 'add' : 'update' ?>">
                    <button type="submit" name="cancel" value="cancel">Cancel</button>
                </td>
            </tr>
        </table>
    </form>
<?php endif; ?>


<?php
function formatTitle($title) {
    return ucwords(str_replace('_', ' ', $title));
}
?>