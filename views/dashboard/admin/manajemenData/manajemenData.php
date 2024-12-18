<?php

use app\cores\Session;

$user = Session::get('user');
?>
<!DOCTYPE html>
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
        <div class="management-option" onclick="showData('admin')">Data Admin</div>
        <div class="management-option" onclick="showData('mahasiswa')">Data Mahasiswa</div>
        <div class="management-option" onclick="showData('dosen')">Data Dosen</div>
        <div class="management-option" onclick="showData('lomba')">Data Info Lomba</div>
        <div class="management-option" onclick="showData('log')">Log Data</div>
    </div>

    <!-- Tabel dan Form untuk menambah data -->
    <div id="data-container" class="data-container"></div>
</div>

<script>
    var adminData = <?php echo json_encode($adminData); ?>;
    var mahasiswaData = <?php echo json_encode($mahasiswaData); ?>;

    function showData(type) {
        let dataContainer = document.getElementById('data-container');
        let dataHTML = '';

        // Admin
        if (type === 'admin') {
            let tableRows = '';
            adminData.forEach(function(item) {
                tableRows += `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.email}</td>
                        <td>${item.name}</td>
                        <td>${item.nip}</td>
                        <td><img src="${item.profile}" alt="Profil" width="40" height="40"></td>
                    </tr>
                `;
            });

            dataHTML = `
                <h3>Data Admin</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Profil</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${tableRows}
                    </tbody>
                </table>
                <h4>Tambah Data Admin Baru</h4>
                <div class="form-container">
                    <input type="text" placeholder="ID Admin" id="admin-id">
                    <input type="email" placeholder="Email Admin" id="admin-email">
                    <input type="text" placeholder="Nama Admin" id="admin-name">
                    <input type="text" placeholder="NIP" id="admin-nip">
                    <input type="file" id="admin-profile">
                    <button onclick="addData('admin')">Tambah Data</button>
                </div>
            `;
        }

        // Mahasiswa
        else if (type === 'mahasiswa') {
            let tableRows = '';
            mahasiswaData.forEach(function(item) {
                tableRows += `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.name}</td>
                        <td>${item.email}</td>
                        <td>${item.nim}</td>
                        <td><img src="${item.profile}" alt="Profil" width="40" height="40"></td>
                        <td>${item.tanggal_lahir}</td>
                        <td>${item.prodi}</td>
                        <td>${item.total_skor}</td>
                    </tr>
                `;
            });

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
                        ${tableRows}
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

        // Add similar blocks for 'dosen', 'lomba', and 'log'

        dataContainer.innerHTML = dataHTML;
    }

    function addData(type) {
        var formData = new FormData();
        var data = {};

        if (type === 'admin') {
            data.id = document.getElementById('admin-id').value;
            data.email = document.getElementById('admin-email').value;
            data.name = document.getElementById('admin-name').value;
            data.nip = document.getElementById('admin-nip').value;
            formData.append("profile", document.getElementById('admin-profile').files[0]);
        }

        if (type === 'mahasiswa') {
            data.id = document.getElementById('mahasiswa-id').value;
            data.name = document.getElementById('mahasiswa-name').value;
            data.email = document.getElementById('mahasiswa-email').value;
            data.nim = document.getElementById('mahasiswa-nim').value;
            data.tanggal_lahir = document.getElementById('mahasiswa-tanggal-lahir').value;
            data.prodi = document.getElementById('mahasiswa-prodi').value;
            data.total_skor = document.getElementById('mahasiswa-total-skor').value;
            formData.append("profile", document.getElementById('mahasiswa-profile').files[0]);
        }

        // Check for missing fields
        if (!data.id || !data.name || !data.email || !data.nim || !data.tanggal_lahir || !data.prodi || !data.total_skor) {
            alert("Harap isi semua field kecuali foto.");
            return;
        }

        // Validate image size
        var profileFile = formData.get("profile");
        if (profileFile && profileFile.size > 5 * 1024 * 1024) { // 5MB
            alert("Foto terlalu besar. Maksimal 5MB.");
            return;
        }

        // Send the data via POST
        formData.append("data", JSON.stringify(data));
        fetch('your_backend_url_here', {
            method: 'POST',
            body: formData
        }).then(response => response.json())
          .then(data => alert("Data berhasil ditambahkan!"))
          .catch(error => alert("Terjadi kesalahan!"));
    }
</script>
