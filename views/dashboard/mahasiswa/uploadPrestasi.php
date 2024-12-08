    <?php

    use app\cores\Session;
    use app\cores\View;

    $user = Session::get('user');
    $data = View::getData();
    $jenisKompetisi = $data["JenisLomba"];
    $tingkatKompetisi = $data["TingkatLomba"];
    $kategoriKompetisi = ["tim", "individu"];
    $urutanPeringkat = $data["Peringkat"];
    $dosenList = $data["Dosen"];


    ?>
    <style>
        body {
            margin: 0;
            font-family: 'Galatea', sans-serif;
            background-color: #f5f5f5;
            color: white;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            padding: 10px 30px;
            background-color: #0039C8;
            color: white;
            align-items: center;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            width: 80px;
            height: 80px;
            margin-right: 15px;
        }

        .navbar .logo h1 {
            font-size: 30px;
            font-weight: 700;
            color: white;
            letter-spacing: 0.5px;
        }

        .navbar .menu {
            display: flex;
            gap: 20px;
        }

        .navbar .menu a {
            text-decoration: none;
            color: white;
            font-size: 20px;
            font-weight: 500;
        }

        .navbar .menu a:hover {
            color: #AFFA08;
        }

        .container {
            max-width: 1000px;
            /* Lebar kontainer lebih lebar */
            margin: 0 auto;
            padding: 30px;
        }

        .form-container {
            background-color: #0039C8;
            padding: 30px;
            padding-bottom: 50px;
            border-radius: 15px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            min-height: 1200px;
            /* Lebih panjang */
            position: relative;
            max-width: 900px;
            /* Menyesuaikan lebar form */
            margin: 0 auto;
            /* Centering form */
        }

        .form-container h3 {
            color: #AFFA08;
            font-size: 35px;
            font-weight: 700;
        }

        .form-container label {
            color: rgba(255, 255, 255, 0.90);
            font-size: 20px;
            font-weight: 400;
        }

        .form-container input,
        .form-container select {
            width: 100%;
            padding: 10px;
            /* Menambah padding untuk kenyamanan */
            margin-top: 5px;
            margin-bottom: 16px;
            border-radius: 25px;
            border: none;
            font-size: 16px;
        }

        .form-container .submit-btn {
            background-color: #AFFA08;
            border-radius: 25px;
            padding: 12px 25px;
            /* Menyesuaikan padding untuk tombol */
            color: black;
            font-size: 20px;
            font-weight: 500;
            text-align: center;
            cursor: pointer;
            border: none;
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        .form-container input[type="file"] {
            padding: 0;
            font-size: 16px;
        }
    </style>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <img src="logoHijau.png" alt="Logo">
            <h1>SIMPA-TI</h1>
        </div>
        <div class="menu">
            <a href="#home">Home</a>
            <a href="#prestasi">Prestasi</a>
            <a href="#leaderboard">Leaderboard</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="form-container">
            <h3>Form Prestasi Mahasiswa</h3>

            <!-- Alert Placeholder -->
            <div id="alert-placeholder"></div>

            <form id="prestasiForm" action="<?php echo '/dashboard/mahasiswa/' . $user . '/submit-prestasi'; ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

                <!-- Jenis Kompetisi -->
                <label for="jenis-kompetisi">Jenis Kompetisi</label>
                <select name="jenis-kompetisi" id="jenis-kompetisi" required>
                    <option value="">Pilih Jenis Kompetisi</option>
                    <?php
                    // Menampilkan pilihan jenis kompetisi dari array
                    foreach ($jenisKompetisi as $jenis) {
                        echo "<option value='" . $jenis['id'] . "'>" . $jenis['jenis_lomba'] . "</option>";
                    }
                    ?>
                </select>

                <!-- Tingkat Kompetisi -->
                <label for="tingkat-kompetisi">Tingkat Kompetisi</label>
                <select name="tingkat-kompetisi" id="tingkat-kompetisi" required>
                    <option value="">Pilih Tingkat Kompetisi</option>
                    <?php
                    // Menampilkan pilihan tingkat kompetisi dari array
                    foreach ($tingkatKompetisi as $tingkat) {
                        echo "<option value='" . $tingkat['id'] . "'>" . $tingkat['tingkat_lomba'] . "</option>";
                    }
                    ?>
                </select>

                <!-- Kategori Kompetisi -->
                <label for="kategori-kompetisi">Kategori Kompetisi</label>
                <select name="kategori-kompetisi" id="kategori-kompetisi" required>
                    <option value="">Pilih Kategori Kompetisi</option>
                    <?php
                    // Menampilkan pilihan kategori kompetisi dari array
                    foreach ($kategoriKompetisi as $kategori) {
                        echo "<option value='$kategori'>" . ucfirst($kategori) . "</option>";
                    }
                    ?>
                </select>

                <!-- peringkat -->
                <label for="peringkat">Peringkat</label>
                <select name="peringkat" id="peringkat" required>
                    <option value="">Pilih peringkat</option>
                    <?php
                    // Menampilkan pilihan kategori kompetisi dari array
                    foreach ($urutanPeringkat as $peringkat) {
                        echo "<option value='" . $peringkat['id'] . "'>" . $peringkat['peringkat'] . "</option>";
                    }
                    ?>
                </select>

                </select>
                <!-- Tempat Kompetisi -->
                <label for="tempat-kompetisi">Tempat Kompetisi</label>
                <input type="text" name="tempat-kompetisi" id="tempat-kompetisi" required>

                <!-- URL Kompetisi -->
                <label for="url-kompetisi">URL Kompetisi</label>
                <input type="url" name="url-kompetisi" id="url-kompetisi">

                <!-- Tanggal Mulai -->
                <label for="tanggal-mulai">Tanggal Mulai</label>
                <input type="date" name="tanggal-mulai" id="tanggal-mulai" required onchange="formatDate(this)">

                <!-- Tanggal Akhir -->
                <label for="tanggal-akhir">Tanggal Akhir</label>
                <input type="date" name="tanggal-akhir" id="tanggal-akhir" required onchange="formatDate(this)">

                <!-- Jumlah PT -->
                <label for="jumlah-pt">Jumlah PT</label>
                <input type="number" name="jumlah-pt" id="jumlah-pt" required>

                <!-- Jumlah Peserta -->
                <label for="jumlah-peserta">Jumlah Peserta</label>
                <input type="number" name="jumlah-peserta" id="jumlah-peserta" required>

                <!-- No Surat Tugas -->
                <label for="no-surat-tugas">No Surat Tugas</label>
                <input type="text" name="no-surat-tugas" id="no-surat-tugas" required>

                <!-- Tanggal Surat Tugas -->
                <label for="tanggal-surat-tugas">Tanggal Surat Tugas</label>
                <input type="date" name="tanggal-surat-tugas" id="tanggal-surat-tugas" required onchange="formatDate(this)">

                <!-- Kategori Partisipasi -->
                <label for="kategori-partisipasi">Kategori Partisipasi</label>
                <input type="text" name="kategori-partisipasi" id="kategori-partisipasi" required>

                <form id="prestasiForm" action="/dashboard/mahasiswa/<?php echo $user; ?>/submit-prestasi" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

                    <!-- Dosen Pembimbing (Multiple Select) -->
                    <label for="dosen-pembimbing">Dosen Pembimbing</label>
                    <select name="dosen-pembimbing[]" id="dosen-pembimbing" multiple required>
                        <option value="">Pilih atau Ketik Dosen Pembimbing</option>
                        <?php
                        // Menampilkan dosen yang sudah ada
                        foreach ($dosenList as $dosen) {
                            echo "<option value='" . $dosen['id'] . "'>" . $dosen['nama'] . "</option>";
                        }
                        ?>
                    </select>

                    <!-- Lampiran File -->
                    <label for="file-surat-tugas">File Surat Tugas</label>
                    <input type="file" name="file-surat-tugas" id="file-surat-tugas" accept=".jpg,.jpeg,.png,.pdf,.docx" required>

                    <label for="file-sertifikat">File Sertifikat</label>
                    <input type="file" name="file-sertifikat" id="file-sertifikat" accept=".jpg,.jpeg,.png,.pdf,.docx" required>

                    <label for="foto-kegiatan">Foto Kegiatan</label>
                    <input type="file" name="foto-kegiatan" id="foto-kegiatan" accept=".jpg,.jpeg,.png,.pdf,.docx" required>

                    <label for="file-poster">File Poster</label>
                    <input type="file" name="file-poster" id="file-poster" accept=".jpg,.jpeg,.png,.pdf,.docx" required>

                    <button type="submit" class="submit-btn">Kirim</button>
                </form>
        </div>
    </div>


    <!-- Script untuk Select2 dan Dynamic Input -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
            // Mengaktifkan Select2 untuk pencarian dosen (multi-select)
            $('#dosen-pembimbing').select2({
                placeholder: 'Cari Dosen Pembimbing',
                allowClear: true,
                tags: true, // memungkinkan pengguna untuk menambah dosen baru
                tokenSeparators: [',', ' '], // Pisahkan dengan koma atau spasi
                createTag: function(params) {
                    // Opsi untuk membuat tag baru jika dosen tidak ditemukan
                    return {
                        id: params.term,
                        text: params.term,
                        newTag: true // Menandakan bahwa ini adalah dosen baru
                    };
                },
                multiple: true, // Memungkinkan memilih lebih dari satu dosen
            });

            // Ketika pengguna memilih atau menambah dosen
            $('#dosen-pembimbing').on('select2:select', function(e) {
                var data = e.params.data;
                if (data.newTag) {
                    // Jika dosen baru, proses tambahan dosen baru ke backend atau array
                    var newDosenName = data.text;
                    console.log("Dosen Baru: " + newDosenName);
                    // Anda bisa menambah dosen baru ke server di sini jika diperlukan
                }
            });
        });

</script>
    <!-- <script>
        
        function formatDate(input) {
            const date = new Date(input.value);
            const formattedDate = date.getFullYear() + '/' + (date.getMonth() + 1).toString().padStart(2, '0') + '/' + date.getDate().toString().padStart(2, '0');
            input.value = formattedDate;
        }

        // Form Validation
        document.getElementById("prestasiForm").addEventListener("submit", function(event) {
            let isValid = true;
            const formElements = this.elements;
            const alertPlaceholder = document.getElementById('alert-placeholder');
            alertPlaceholder.innerHTML = ""; // Clear previous alerts

            // Check if all fields are filled
            for (let i = 0; i < formElements.length; i++) {
                if (formElements[i].required && formElements[i].value.trim() === "") {
                    isValid = false;
                    break;
                }
            }

            if (!isValid) {
                // Show Bootstrap alert for incomplete form
                alertPlaceholder.innerHTML = `
                <div class="alert alert-danger" role="alert">
                    Semua kolom wajib diisi!
                </div>
            `;
                event.preventDefault(); // Prevent form submission
            } else {
                // Show Bootstrap alert for success after submission
                alertPlaceholder.innerHTML = `
                <div class="alert alert-success" role="alert">
                    Form berhasil dikirim!
                </div>
            `;
            }
        });
    </script> -->