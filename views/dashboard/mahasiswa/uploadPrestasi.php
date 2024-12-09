a<?php
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
        padding: 12px 25px;
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

    /* Autocomplete Styles */
    .autocomplete {
        position: relative;
        display: inline-block;
    }

    input[type="text"] {
        background-color: #f1f1f1;
        padding: 10px;
        font-size: 16px;
        width: 100%;
    }

    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        top: 100%;
        left: 0;
        right: 0;
        max-height: 150px;
        overflow-y: auto;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    .autocomplete-items div:hover {
        background-color: #e9e9e9;
    }

    .autocomplete-active {
        background-color: DodgerBlue;
        color: #ffffff;
    }
</style>

<!-- Navbar -->
<div class="navbar">
    <div class="logo">
        <img src="../public/component/logoHijau.png" alt="Logo">
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

            <!-- No Surat -->
            <label for="no-surat">No Surat</label>
            <input type="text" name="no-surat" id="no-surat" required>

            <!-- Dosen Pembimbing -->
            <label for="dosen-pembimbing">Dosen Pembimbing</label>
            <div class="autocomplete" style="width:100%;">
                <input id="dosen-input" type="text" name="dosen-pembimbing" placeholder="Pilih Dosen Pembimbing" required>
            </div>

            <!-- Hidden Input for Dosen ID -->
            <input type="hidden" name="dosen-pembimbing-id" id="dosen-id">

            <!-- Add Dosen Button -->
            <button type="button" class="btn-tambah" id="add-dosen">Tambah Dosen</button>

            <!-- File Input -->
            <label for="file">Upload File</label>
            <input type="file" name="file" id="file" required>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script>
// List of dosen names from PHP
var dosenList = <?php echo json_encode($dosenList); ?>;
var dosenNames = dosenList.map(dosen => dosen['nama']); // Extracting only the names

// Initialize autocomplete functionality
autocomplete(document.getElementById("dosen-input"), dosenNames);

// Autocomplete function
function autocomplete(inp, arr) {
  var currentFocus;
  inp.addEventListener("input", function(e) {
    var a, b, i, val = this.value;
    closeAllLists();
    if (!val) { return false;}
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
          document.getElementById("dosen-id").value = getDosenId(inp.value); // Get the Dosen ID based on the selected name
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

  function getDosenId(dosenName) {
    var dosen = dosenList.find(d => d['nama'] === dosenName);
    return dosen ? dosen['id'] : '';
  }
}
</script>
