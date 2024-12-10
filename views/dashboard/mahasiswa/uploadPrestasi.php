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
        <img class="logo" src="../../../public/component/logoHijau.png" alt="Logo">
        <h1>SIMPA-TI</h1>
    </div>
    <div class="menu">
        <a href="#home">Home</a>
        <a href="#prestasi">Prestasi</a>
        <a href="#leaderboard">Leaderboard</a>
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
                <input type="file" name="file-foto-kegiatan" id="file-foto-kegiatan" accept=".jpg,.jpeg,.png,.pdf,.docx" required>

                <!-- File Poster -->
                <label for="file-poster">File Poster</label>
                <input type="file" name="file-poster" id="file-poster" accept=".jpg,.jpeg,.png,.pdf,.docx" required>

                <button type="submit" class="submit-btn">Kirim</button>
            </form>
        </div>
    </div>



    <script>
        var dosenList = <?php echo json_encode($dosenList); ?>; // PHP array passed to JS
        var dosenNames = dosenList.map(function(dosen) {
            return dosen.nama; // Extracting dosen names
        });

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
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        b = document.createElement("DIV");
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        b.addEventListener("click", function(e) {
                            inp.value = this.getElementsByTagName("input")[0].value;
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

        // Function to add new dosen input field and delete button
        document.getElementById("addDosenBtn").addEventListener("click", function() {
            var container = document.getElementById("dosenFieldsContainer");

            // Create a new div for the new dosen input
            var newDiv = document.createElement("div");
            newDiv.classList.add("dosen-container");

            // Create the input field for dosen
            var inputField = document.createElement("input");
            inputField.setAttribute("type", "text");
            inputField.setAttribute("placeholder", "Dosen Pembimbing");
            inputField.setAttribute("name", "dosen[]"); // Make it an array to send multiple dosen names in the form
            newDiv.appendChild(inputField);

            // Initialize autocomplete on the new input field
            autocomplete(inputField, dosenNames);

            // Create delete button for this dosen input
            var deleteButton = document.createElement("button");
            deleteButton.innerText = "Hapus";
            deleteButton.addEventListener("click", function() {
                container.removeChild(newDiv); // Remove the corresponding input field and delete button
            });
            newDiv.appendChild(deleteButton);

            // Append the new div to the container
            container.appendChild(newDiv);
        });
    </script>

    <script>
        // Fetch the PHP array and create an array of dosen names
        var dosenList = <?php echo json_encode($dosenList); ?>;
        var dosenNames = dosenList.map(function(dosen) {
            return dosen.nama; // Extract the 'nama' of each dosen
        });

        // Autocomplete function
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
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        b = document.createElement("DIV");
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";

                        b.addEventListener("click", function(e) {
                            inp.value = this.getElementsByTagName("input")[0].value;
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

        // Initialize the autocomplete function
        autocomplete(document.getElementById("dosenInput"), dosenNames);
    </script>

    <script>
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
    </script>