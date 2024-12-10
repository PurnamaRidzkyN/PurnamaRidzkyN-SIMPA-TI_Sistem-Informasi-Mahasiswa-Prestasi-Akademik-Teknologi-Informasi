<?php

use app\cores\Session;
use app\cores\View;
use app\helpers\Dump;

$user = Session::get('user');
$data = View::getData();
$jenisKompetisi = $data["JenisLomba"];
$tingkatKompetisi = $data["TingkatLomba"];
$kategoriKompetisi = ["tim", "individu"];
$urutanPeringkat = $data["Peringkat"];
$dosenList = $data["Dosen"];
?>

<!-- Styles -->
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
        position: relative;
        max-width: 900px;
        margin: 0 auto;
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
        margin-top: 5px;
        margin-bottom: 16px;
        border-radius: 25px;
        border: none;
        font-size: 16px;
    }

    .dosen-entry {
        margin-bottom: 16px;
    }

    .dosen-select {
        width: 100%;
        padding: 10px;
        border-radius: 25px;
        border: none;
        font-size: 16px;
        margin-top: 5px;
    }

    .btn-tambah {
        background-color: #AFFA08;
        padding: 10px 20px;
        border: none;
        border-radius: 25px;
        color: black;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        margin-bottom: 16px;
    }

    .btn-tambah:hover {
        background-color: #c5ff5f;
    }

    .form-container .submit-btn {
        background-color: #AFFA08;
        border-radius: 25px;
        padding: 10px 20px;
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


    /* Green "Tambah Dosen" button with rounded borders */
    #addDosenBtn {
        background-color: #AFFA08;
        padding: 5px 10px;
        border: none;
        border-radius: 25px;
        color: black;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
    }

    #addDosenBtn:hover {
        background-color: #218838;
        /* Darker green for hover effect */
    }

    /* Red "Hapus" button with rounded borders */
    .dosen-container button {
        background-color: #dc3545;
        padding: 5px 10px;
        border: none;
        border-radius: 25px;
        color: white;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        margin-bottom: 10px;
    }

    .dosen-container button:hover {
        background-color: #c82333;
        /* Darker red for hover effect */
    }
</style>

<!-- Navbar -->
<div class="navbar">
    <div class="logo">
        <img src="../../../public/component/logoHijau.png" alt="Logo">
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

        <form id="prestasiForm" action="/dashboard/mahasiswa/<?php echo $user; ?>/submit-prestasi" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

            <!-- Jenis Kompetisi -->
            <label for="jenis-kompetisi">Jenis Kompetisi</label>
            <select name="jenis-kompetisi" id="jenis-kompetisi" required>
                <option value="">Pilih Jenis Kompetisi</option>
                <?php foreach ($jenisKompetisi as $jenis) : ?>
                    <option value="<?php echo $jenis['id']; ?>"><?php echo $jenis['jenis_lomba']; ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Tingkat Kompetisi -->
            <label for="tingkat-kompetisi">Tingkat Kompetisi</label>
            <select name="tingkat-kompetisi" id="tingkat-kompetisi" required>
                <option value="">Pilih Tingkat Kompetisi</option>
                <?php foreach ($tingkatKompetisi as $tingkat) : ?>
                    <option value="<?php echo $tingkat['id']; ?>"><?php echo $tingkat['tingkat_lomba']; ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Kompetisi -->
            <label for="judul-kompetisi">Judul kompetisi</label>
            <input type="text" name="judul-kompetisi" id="judul-kompetisi" required>

            <!-- Kompetisi -->
            <label for="judul-kompetisi">Judul kompetisi (English) </label>
            <input type="text" name="judul-kompetisi-en" id="judul-kompetisi" required>

            <!-- Kategori Kompetisi -->
            <label for="kategori-kompetisi">Kategori Kompetisi</label>
            <select name="kategori-kompetisi" id="kategori-kompetisi" required>
                <option value="">Pilih Kategori Kompetisi</option>
                <?php foreach ($kategoriKompetisi as $kategori) : ?>
                    <option value="<?php echo $kategori; ?>"><?php echo ucfirst($kategori); ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Peringkat -->
            <label for="peringkat">Peringkat</label>
            <select name="peringkat" id="peringkat" required>
                <option value="">Pilih Peringkat</option>
                <?php foreach ($urutanPeringkat as $peringkat) : ?>
                    <option value="<?php echo $peringkat['id']; ?>"><?php echo $peringkat['peringkat']; ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Tempat Kompetisi -->
            <label for="tempat-kompetisi">Tempat Kompetisi</label>
            <input type="text" name="tempat-kompetisi" id="tempat-kompetisi" required>

            <!-- Tempat Kompetisi -->
            <label for="tempat-kompetisi">Tempat Kompetisi (English)</label>
            <input type="text" name="tempat-kompetisi-en" id="tempat-kompetisi" required>

            <!-- URL Kompetisi -->
            <label for="url-kompetisi">URL Kompetisi</label>
            <input type="url" name="url-kompetisi" id="url-kompetisi" required>

            <!-- Tanggal Mulai -->
            <label for="tanggal-mulai">Tanggal Mulai</label>
            <input type="date" name="tanggal-mulai" id="tanggal-mulai" required onchange="formatDate(this)">

            <!-- Tanggal Akhir -->
            <label for="tanggal-akhir">Tanggal Akhir</label>
            <input type="date" name="tanggal-akhir" id="tanggal-akhir" required onchange="formatDate(this)">

            <!-- PT -->
            <label for="jumlah-pt">Jumlah PT (Berpartisipasi) </label>
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

            <!-- Dosen Pembimbing -->
            <label for="dosen-pembimbing">Dosen Pembimbing</label>
            <button id="addDosenBtn">Tambah Dosen</button>

            <!-- Container to hold the dosen input fields -->
            <div id="dosenFieldsContainer"></div>

            <!-- File Surat Tugas -->
            <label for="file-surat-tugas">File Surat Tugas</label>
            <input type="file" name="file-surat-tugas" id="file-surat-tugas" accept=".jpg,.jpeg,.png,.pdf,.docx" required>

            <!-- File Sertifikat -->
            <label for="file-sertifikat">File Sertifikat</label>
            <input type="file" name="file-sertifikat" id="file-sertifikat" accept=".jpg,.jpeg,.png,.pdf,.docx" required>

            <!-- Foto Kegiatan -->
            <label for="file-foto-kegiatan">Foto Kegiatan</label>
            <input type="file" name="file-foto-kegiatan" id="file-foto-kegiatan" accept=".jpg,.jpeg,.png,.pdf" required>

            <!-- File Poster -->
            <label for="file-poster">File Poster</label>
            <input type="file" name="file-poster" id="file-poster" accept=".jpg,.jpeg,.png,.pdf" required>
            <div class="text-danger mb-3" id="error-message">
                <!-- PHP error message will be inserted here -->
                <?php echo app\cores\View::getData()["error"] ?? "" ?>
            </div>

            <button type="submit" class="submit-btn">Kirim</button>
        </form>
    </div>
</div>
</div>

<script>
    var dosenCounter = 1;

    // Data dosen yang sudah diambil dari PHP
    var dosenList = <?php echo json_encode($dosenList); ?>;
    var dosenNames = dosenList.map(function(dosen) {
        return {
            name: dosen.nama,
            id: dosen.id
        }; // Menyimpan nama dan ID dosen
    });


    // Menambahkan event listener untuk tombol tambah dosen
    document.getElementById("addDosenBtn").addEventListener("click", function(event) {
        event.preventDefault(); // Menghindari form dikirim saat tombol diklik

        var container = document.getElementById("dosenFieldsContainer");

        // Membuat div baru untuk input dosen
        var newDiv = document.createElement("div");
        newDiv.classList.add("dosen-container");

        // Membuat input field untuk dosen
        var inputField = document.createElement("input");
        inputField.setAttribute("type", "text");
        inputField.setAttribute("placeholder", "Dosen Pembimbing");
        inputField.setAttribute("name", "dosen-" + dosenCounter); // Menambahkan nama unik untuk input
        inputField.setAttribute("data-id", ""); // Menyimpan ID dosen di atribut data-id
        newDiv.appendChild(inputField);

        // Menginisialisasi autocomplete pada input baru
        autocomplete(inputField, dosenNames);

        // Membuat tombol hapus untuk input dosen ini
        var deleteButton = document.createElement("button");
        deleteButton.innerText = "Hapus";
        deleteButton.addEventListener("click", function() {
            container.removeChild(newDiv); // Menghapus input dosen dan tombol hapus
        });
        newDiv.appendChild(deleteButton);

        // Menambahkan div baru ke container
        container.appendChild(newDiv);

        // Menambah counter dosen untuk input berikutnya
        dosenCounter++;
    });

    // Fungsi autocomplete untuk input dosen
    function autocomplete(inp, arr) {
        var currentFocus;

        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            closeAllLists();

            if (!val) {
                return false;
            }

            currentFocus = -1;
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            this.parentNode.appendChild(a);

            for (i = 0; i < arr.length; i++) {
                if (arr[i].name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    b = document.createElement("DIV");
                    b.innerHTML = "<strong>" + arr[i].name.substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].name.substr(val.length);
                    b.innerHTML += "<input type='hidden' value='" + arr[i].id + "'>"; // Menyimpan ID dosen

                    b.addEventListener("click", function(e) {
                        inp.value = this.innerText; // Menampilkan nama dosen di input
                        inp.setAttribute("data-id", this.getElementsByTagName("input")[0].value); // Menyimpan ID dosen di atribut data-id
                        closeAllLists();
                    });

                    a.appendChild(b);
                }
            }
        });

        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                currentFocus++;
                addActive(x);
            } else if (e.keyCode == 38) {
                currentFocus--;
                addActive(x);
            } else if (e.keyCode == 13) {
                e.preventDefault();
                if (currentFocus > -1) {
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            if (!x) return false;
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }

        document.addEventListener("click", function(e) {
            closeAllLists(e.target);
        });
    }

    document.getElementById("prestasiForm").addEventListener("submit", function(event) {
        var isValid = true; // Flag untuk mengecek validitas formulir
        var formFields = document.querySelectorAll("#prestasiForm input, #prestasiForm select");
        var errorMessage = document.getElementById("error-message");

        // Reset pesan error
        errorMessage.innerHTML = "";

        formFields.forEach(function(field) {
            if (!field.value) {
                isValid = false; // Jika ada field kosong
                field.style.border = "2px solid red"; // Tambahkan gaya untuk menandai field
            } else {
                field.style.border = ""; // Hapus gaya jika valid
            }
        });

        if (!isValid) {
            event.preventDefault(); // Menghentikan pengiriman formulir
            errorMessage.innerHTML = "Semua field harus diisi sebelum mengirim formulir!";
        }
    });
</script>