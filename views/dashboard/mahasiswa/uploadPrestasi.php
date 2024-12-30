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
$namaList = array_map(function ($dosen) {
  return $dosen['nama'];  // Mengambil 'nama' dari tiap elemen
}, $dosenList);

?>

<!-- Styles -->
<style>
  body {
    margin: 0;
    font-family: 'Galatea', sans-serif;
    background-color: #f5f5f5;
    color: white;
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
    min-height: 1000px;
    position: relative;
    max-width: 900px;
    margin: 0 auto;
  }

  .form-container h3 {
    color: #AFFA08;
    font-size: 35px;
    font-weight: 700;
    text-align: center;
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

  .form-row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }

  .form-row .form-group {
    flex: 1;
    min-width: 300px;
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

  .form-container .submit-btn {
    background-color: #AFFA08;
    border-radius: 25px;
    padding: 5px 10px;
    color: black;
    font-size: 15px;
    font-weight: 500;
    text-align: center;
    cursor: pointer;
    border: none;
    position: absolute;
    bottom: 20px;
    left: 20px;
  }

  .form-container .submit-btn:hover {
    background-color: #c5ff5f;
  }

  .form-container .back-btn {
    background-color: #dc3545;
    color: white;
    border: none;
    border-radius: 25px;
    padding: 5px 10px;
    font-size: 15px;
    font-weight: 500;
    text-align: center;
    cursor: pointer;
    position: absolute;
    bottom: 20px;
    right: 20px;
  }

  .form-container .back-btn:hover {
    background-color: #c82333;
  }


  .form-container input[type="file"] {
    padding: 0;
    font-size: 16px;
  }

  /* Gaya untuk tombol tambah dosen */
  .btn-tambah {
    background-color: #AFFA08;
    padding: 5px 10px;
    border: none;
    border-radius: 25px;
    color: black;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    margin-left: 16px;
    /* Tambahkan jarak dengan label */
  }

  .btn-tambah:hover {
    background-color: #c5ff5f;
  }

  /* Gaya untuk label */
  label {
    font-size: 16px;
    font-weight: bold;
    display: inline-block;
    margin-right: 8px;
    color: white;
  }

  /* Gaya untuk elemen autocomplete */
  .autocomplete {
    position: relative;
    display: inline-block;
    margin-bottom: 5x;
  }

  input {
    border: 1px solid #d4d4d4;
    background-color: #f9f9f9;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    width: 100%;
  }

  .autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    z-index: 99;
    top: 100%;
    left: 0;
    right: 0;
    background-color: white;
  }

  .autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid #d4d4d4;
    color: black;
  }

  .autocomplete-items div:hover {
    background-color: #e9e9e9;
  }

  .autocomplete-active {
    background-color: DodgerBlue !important;
    color: white;
  }

  /* Gaya untuk daftar dosen yang dipilih */
  .selected-items {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    margin-bottom: 0px;
  }

  .selected-items .item {
    background-color: #f1f1f1;
    border: 1px solid #d4d4d4;
    padding: 5px 10px;
    border-radius: 25px;
    display: flex;
    align-items: center;
    color: black;
  }

  .selected-items .item span {
    margin-left: 10px;
    cursor: pointer;
    color: red;
    font-weight: bold;
  }

  /* Tambahkan jarak antara label dan input */
  .label-container {
    margin-bottom: 10px;
    /* Jarak antara label dan input form */
  }


  .upload-form-container label {
    color: rgba(255, 255, 255, 0.90);
    font-size: 20px;
    font-weight: 400;
  }

  .upload-form-container input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 16px;
    border-radius: 25px;
    border: none;
    font-size: 16px;
    background-color: #f9f9f9;
    color: black;
  }

  .upload-file-name {
    color: #fff;
    margin-top: -10px;
    margin-bottom: 16px;
    font-size: 14px;
    font-style: italic;
  }
</style>

<!-- Main Content -->
<div class="container">
  <div class="form-container">
    <h3>Tambah Prestasi Mahasiswa</h3>

    <!-- Alert Placeholder -->
    <div id="alert-placeholder"></div>

    <form id="prestasiForm" action="/dashboard/mahasiswa/<?php echo $user; ?>/submit-prestasi" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

      <!-- Jenis Kompetisi, Tingkat Kompetisi, Kategori, Peringkat -->
      <div class="form-row">
        <div class="form-group">
          <label for="jenis-kompetisi">Jenis Kompetisi</label>
          <select name="jenis-kompetisi" id="jenis-kompetisi" required>
            <option value="">Pilih Jenis Kompetisi</option>
            <?php foreach ($jenisKompetisi as $jenis) : ?>
              <option value="<?php echo $jenis['id']; ?>"><?php echo $jenis['jenis_lomba']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="tingkat-kompetisi">Tingkat Kompetisi</label>
          <select name="tingkat-kompetisi" id="tingkat-kompetisi" required>
            <option value="">Pilih Tingkat Kompetisi</option>
            <?php foreach ($tingkatKompetisi as $tingkat) : ?>
              <option value="<?php echo $tingkat['id']; ?>"><?php echo $tingkat['tingkat_lomba']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="kategori-kompetisi">Kategori Kompetisi</label>
          <select name="kategori-kompetisi" id="kategori-kompetisi" required>
            <option value="">Pilih Kategori Kompetisi</option>
            <?php foreach ($kategoriKompetisi as $kategori) : ?>
              <option value="<?php echo $kategori; ?>"><?php echo ucfirst($kategori); ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="peringkat">Peringkat</label>
          <select name="peringkat" id="peringkat" required>
            <option value="">Pilih Peringkat</option>
            <?php foreach ($urutanPeringkat as $peringkat) : ?>
              <option value="<?php echo $peringkat['id']; ?>"><?php echo $peringkat['peringkat']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>


      <!-- Tempat Kompetisi, URL Kompetisi, Tanggal Mulai, Tanggal Akhir -->
      <div class="form-group">
        <label for="judul-kompetisi">Judul Kompetisi</label>
        <input type="text" name="judul-kompetisi" id="judul-kompetisi" placeholder="Masukkan Judul Kompetisi" required>
      </div>

      <div class="form-group">
        <label for="judul-kompetisi">Judul Kompetisi EN</label>
        <input type="text" name="judul-kompetisi-en" id="judul-kompetisi-en" placeholder="Masukkan Judul Kompetisi EN" required>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="tempat-kompetisi">Tempat Kompetisi</label>
          <input type="text" name="tempat-kompetisi" id="tempat-kompetisi" placeholder="Masukkan Tempat Kompetisi" required>

        </div>

        <div class="form-group">
          <label for="tempat-kompetisi">Tempat Kompetisi EN</label>
          <input type="text" name="tempat-kompetisi-en" id="tempat-kompetisi-en" placeholder="Masukkan Tempat Kompetisi EN" required>

        </div>

        <div class="form-group">
          <label for="url-kompetisi">URL Kompetisi</label>
          <input type="url" name="url-kompetisi" id="url-kompetisi" placeholder="Masukkan URL Kompetisi" required>
        </div>


        <div class="form-group">
          <label for="tanggal-mulai">Tanggal Mulai</label>
          <input type="date" name="tanggal-mulai" id="tanggal-mulai" required onchange="formatDate(this)">
        </div>

        <div class="form-group">
          <label for="tanggal-akhir">Tanggal Akhir</label>
          <input type="date" name="tanggal-akhir" id="tanggal-akhir" required onchange="formatDate(this)">
        </div>
      </div>

      <!-- Jumlah PT, Jumlah Peserta, No Surat Tugas, Tanggal Surat Tugas -->
      <div class="form-row">
        <div class="form-group">
          <label for="jumlah-pt">Jumlah PT (Berpartisipasi)</label>
          <input type="number" name="jumlah-pt" id="jumlah-pt" placeholder="Masukkan Jumlah PT" required>
        </div>

        <div class="form-group">
          <label for="jumlah-peserta">Jumlah Peserta</label>
          <input type="number" name="jumlah-peserta" id="jumlah-peserta" placeholder="Masukkan Jumlah Peserta" required>
        </div>

        <div class="form-group">
          <label for="no-surat-tugas">No Surat Tugas</label>
          <input type="text" name="no-surat-tugas" id="no-surat-tugas" placeholder="Masukkan No Surat Tugas" required>
        </div>

        <div class="form-group">
          <label for="tanggal-surat-tugas">Tanggal Surat Tugas</label>
          <input type="date" name="tanggal-surat-tugas" id="tanggal-surat-tugas" required onchange="formatDate(this)">
        </div>
      </div>


      <!-- Label untuk dosen pembimbing -->
      <div class="label-container" style="display: flex; align-items: center;">
        <label for="dosen-pembimbing">Dosen Pembimbing</label>
        <button id="addDosenBtn" class="btn-tambah">Tambah Dosen</button>
      </div>

      <!-- Form autocomplete -->
      <div class="autocomplete" style="width:300px;">
        <input id="dosenInput" type="text" placeholder="Masukkan Nama Dosen">
      </div>
      <div id="selectedDosen" class="selected-items"></div>
      <input type="hidden" name="dosenList" id="dosenList">


      <!-- File Surat Tugas, File Sertifikat, Foto Kegiatan, File Poster -->
      <div class="upload-form-container">
            <!-- File Surat Tugas -->
            <label for="fileSuratTugas">File Surat Tugas:</label>
            <input type="file" id="fileSuratTugas" name="fileSuratTugas" accept=".pdf,.doc,.docx">
            <span class="upload-file-name" id="fileSuratTugasName"></span>

            <!-- File Sertifikat -->
            <label for="fileSertifikat">File Sertifikat:</label>
            <input type="file" id="fileSertifikat" name="fileSertifikat" accept=".pdf,.doc,.docx">
            <span class="upload-file-name" id="fileSertifikatName"></span>

            <!-- Foto Kegiatan -->
            <label for="fotoKegiatan">Foto Kegiatan:</label>
            <input type="file" id="fotoKegiatan" name="fotoKegiatan" accept="image/*">
            <span class="upload-file-name" id="fotoKegiatanName"></span>

            <!-- File Poster -->
            <label for="filePoster">File Poster:</label>
            <input type="file" id="filePoster" name="filePoster" accept="image/*">
            <span class="upload-file-name" id="filePosterName"></span>
        </div>

      <div class="text-danger mb-3" id="error-message">
        <!-- PHP error message will be inserted here -->
        <?php  app\cores\View::getData() ?? "" ?>
      </div>

      <button type="submit" class="submit-btn">Kirim</button>
      <button type="button" class="back-btn" onclick="history.back()">Kembali</button>
    </form>
  </div>
</div>
<script>
  // Skrip autocomplete seperti sebelumnya
  function autocomplete(inp, arr) {
    let currentFocus;
    inp.addEventListener("input", function() {
      let a, b, i, val = this.value;
      closeAllLists();
      if (!val) return false;
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
          b.addEventListener("click", function() {
            addSelectedItem(inp, this.getElementsByTagName("input")[0].value);
            inp.value = "";
            closeAllLists();
          });
          a.appendChild(b);
        }
      }
    });
    inp.addEventListener("keydown", function(e) {
      let x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        currentFocus++;
        addActive(x);
      } else if (e.keyCode == 38) {
        currentFocus--;
        addActive(x);
      } else if (e.keyCode == 13) {
        e.preventDefault();
        if (currentFocus > -1 && x) x[currentFocus].click();
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
      for (let i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }

    function closeAllLists(elmnt) {
      let x = document.getElementsByClassName("autocomplete-items");
      for (let i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }
    document.addEventListener("click", function(e) {
      closeAllLists(e.target);
    });
  }

  // Skrip untuk menambah dan menghapus dosen terpilih
  function addSelectedItem(inputElement, value) {
    const selectedContainer = document.getElementById("selectedDosen");
    const hiddenInput = document.getElementById("dosenList");

    const existingItems = Array.from(selectedContainer.children).map(item => item.dataset.value);
    if (existingItems.includes(value)) return;

    const item = document.createElement("div");
    item.setAttribute("class", "item");
    item.setAttribute("data-value", value);
    item.innerHTML = `${value} <span onclick="removeSelectedItem(this)">\u00d7</span>`;
    selectedContainer.appendChild(item);

    const updatedList = [...existingItems, value];
    hiddenInput.value = updatedList.join(",");
  }

  function removeSelectedItem(element) {
    const item = element.parentNode;
    const value = item.dataset.value;
    const selectedContainer = document.getElementById("selectedDosen");
    const hiddenInput = document.getElementById("dosenList");

    selectedContainer.removeChild(item);

    const remainingItems = Array.from(selectedContainer.children).map(item => item.dataset.value);
    hiddenInput.value = remainingItems.join(",");
  }

  // Tampilkan form saat tombol "Tambah Dosen" diklik
  const addDosenBtn = document.getElementById("addDosenBtn");
  addDosenBtn.addEventListener("click", function(e) {
    e.preventDefault();
    document.getElementById("autocompleteForm").style.display = "block";
    addDosenBtn.style.display = "none";
  });

  /* Daftar nama dosen */
  const dosenList = <?php echo json_encode($namaList); ?>;
  /* Inisialisasi autocomplete pada input */
  autocomplete(document.getElementById("dosenInput"), dosenList);


  document.getElementById("prestasiForm").addEventListener("submit", function(event) {
    var isValid = true; // Flag untuk mengecek validitas formulir
    var formFields = document.querySelectorAll("#prestasiForm input, #prestasiForm select");
    var errorMessage = document.getElementById("error-message");

    // Reset pesan error
    errorMessage.innerHTML = "";

    formFields.forEach(function(field) {
      // Cek validasi untuk semua field, kecuali input dosen
      if (field.id !== "dosenInput" && field.id !== "dosenList") {
        if (!field.value) {
          isValid = false; // Jika ada field kosong
          field.style.border = "2px solid red"; // Tambahkan gaya untuk menandai field
        } else {
          field.style.border = ""; // Hapus gaya jika valid
        }
      }
    });

    // Cek apakah dosen telah dipilih atau tidak, jika dosen tidak wajib
    var dosenInput = document.getElementById("dosenInput").value;
    var dosenList = document.getElementById("dosenList").value;
    if (!dosenInput && !dosenList) {
      // Jika tidak ada dosen yang dipilih, tidak perlu menambahkan pesan error
      // Kamu bisa tambahkan pengecekan lain jika dosen perlu validasi tertentu
    }

    if (!isValid) {
      event.preventDefault(); // Menghentikan pengiriman formulir
      errorMessage.innerHTML = "Semua field harus diisi sebelum mengirim formulir!";
    }
  });
</script>