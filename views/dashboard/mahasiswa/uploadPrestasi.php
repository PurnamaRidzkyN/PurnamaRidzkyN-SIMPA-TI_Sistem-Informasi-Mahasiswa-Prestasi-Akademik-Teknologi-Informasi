<?php
// Contoh array PHP untuk data ID yang akan ditampilkan dalam dropdown
$id_jenis_kompetisi = ["1" => "Lomba Coding", "2" => "Lomba Desain", "3" => "Lomba Menulis"];
$id_tingkat_kompetisi = ["1" => "Nasional", "2" => "Regional", "3" => "Internasional"];
$id_mahasiswa = ["1" => "John Doe", "2" => "Jane Doe", "3" => "Alice"];
$id_peringkat = ["1" => "Juara 1", "2" => "Juara 2", "3" => "Juara 3"];
$id_admin = ["1" => "Admin A", "2" => "Admin B", "3" => "Admin C"];


use app\cores\Session;

$user = Session::get('user');
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Form Upload Prestasi</h1>
    <form action="<?php echo '/dashboard/mahasiswa/' . $user . '/submit-prestasi'; ?>"" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

        <div class="mb-3">
            <label for="id_jenis_kompetisi" class="form-label">Jenis Kompetisi</label>
            <select id="id_jenis_kompetisi" name="id_jenis_kompetisi" class="form-select" required>
                <option value="" disabled selected>Pilih Jenis Kompetisi</option>
                <?php foreach ($id_jenis_kompetisi as $key => $value): ?>
                    <option value="<?= htmlspecialchars($key) ?>"><?= htmlspecialchars($value) ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Silakan pilih jenis kompetisi.</div>
        </div>

        <div class="mb-3">
            <label for="id_tingkat_kompetisi" class="form-label">Tingkat Kompetisi</label>
            <select id="id_tingkat_kompetisi" name="id_tingkat_kompetisi" class="form-select" required>
                <option value="" disabled selected>Pilih Tingkat Kompetisi</option>
                <?php foreach ($id_tingkat_kompetisi as $key => $value): ?>
                    <option value="<?= htmlspecialchars($key) ?>"><?= htmlspecialchars($value) ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Silakan pilih tingkat kompetisi.</div>
        </div>

        <div class="mb-3">
            <label for="id_peringkat" class="form-label">Peringkat</label>
            <select id="id_peringkat" name="id_peringkat" class="form-select" required>
                <option value="" disabled selected>Pilih Peringkat</option>
                <?php foreach ($id_peringkat as $key => $value): ?>
                    <option value="<?= htmlspecialchars($key) ?>"><?= htmlspecialchars($value) ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Silakan pilih peringkat.</div>
        </div>

        <div class="mb-3">
            <label for="id_admin" class="form-label">Admin</label>
            <select id="id_admin" name="id_admin" class="form-select" required>
                <option value="" disabled selected>Pilih Admin</option>
                <?php foreach ($id_admin as $key => $value): ?>
                    <option value="<?= htmlspecialchars($key) ?>"><?= htmlspecialchars($value) ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Silakan pilih admin.</div>
        </div>

        <div class="mb-3">
            <label for="tim" class="form-label">Tim</label>
            <input type="text" id="tim" name="tim" class="form-control" placeholder="Masukkan nama tim" required>
            <div class="invalid-feedback">Silakan masukkan nama tim.</div>
        </div>

        <div class="mb-3">
            <label for="judul_kompetisi" class="form-label">Judul Kompetisi</label>
            <input type="text" id="judul_kompetisi" name="judul_kompetisi" class="form-control" placeholder="Masukkan Judul Kompetisi" required>
            <div class="invalid-feedback">Silakan masukkan judul kompetisi.</div>
        </div>

        <div class="mb-3">
            <label for="judul_kompetisi_en" class="form-label">Judul Kompetisi (English)</label>
            <input type="text" id="judul_kompetisi_en" name="judul_kompetisi_en" class="form-control" placeholder="Masukkan Judul Kompetisi (English)">
        </div>

        <div class="mb-3">
            <label for="tempat_kompetisi" class="form-label">Tempat Kompetisi</label>
            <input type="text" id="tempat_kompetisi" name="tempat_kompetisi" class="form-control" placeholder="Masukkan tempat kompetisi" required>
            <div class="invalid-feedback">Silakan masukkan tempat kompetisi.</div>
        </div>

        <div class="mb-3">
            <label for="tempat_kompetisi_en" class="form-label">Tempat Kompetisi (English)</label>
            <input type="text" id="tempat_kompetisi_en" name="tempat_kompetisi_en" class="form-control" placeholder="Masukkan tempat kompetisi (English)">
        </div>

        <div class="mb-3">
            <label for="url_kompetisi" class="form-label">URL Kompetisi</label>
            <input type="url" id="url_kompetisi" name="url_kompetisi" class="form-control" placeholder="Masukkan URL kompetisi">
        </div>

        <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control" required>
            <div class="invalid-feedback">Silakan masukkan tanggal mulai.</div>
        </div>

        <div class="mb-3">
            <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
            <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control" required>
            <div class="invalid-feedback">Silakan masukkan tanggal akhir.</div>
        </div>

        <div class="mb-3">
            <label for="jumlah_pt" class="form-label">Jumlah Perguruan Tinggi</label>
            <input type="number" id="jumlah_pt" name="jumlah_pt" class="form-control" placeholder="Masukkan jumlah perguruan tinggi" required>
            <div class="invalid-feedback">Silakan masukkan jumlah perguruan tinggi.</div>
        </div>

        <div class="mb-3">
            <label for="jumlah_peserta" class="form-label">Jumlah Peserta</label>
            <input type="number" id="jumlah_peserta" name="jumlah_peserta" class="form-control" placeholder="Masukkan jumlah peserta" required>
            <div class="invalid-feedback">Silakan masukkan jumlah peserta.</div>
        </div>

        <div class="mb-3">
            <label for="no_surat_tugas" class="form-label">No Surat Tugas</label>
            <input type="text" id="no_surat_tugas" name="no_surat_tugas" class="form-control" placeholder="Masukkan nomor surat tugas">
        </div>

        <div class="mb-3">
            <label for="tanggal_surat_tugas" class="form-label">Tanggal Surat Tugas</label>
            <input type="date" id="tanggal_surat_tugas" name="tanggal_surat_tugas" class="form-control">
        </div>

        <div class="mb-3">
            <label for="file_surat_tugas" class="form-label">File Surat Tugas (PDF)</label>
            <input type="file" id="file_surat_tugas" name="file_surat_tugas" class="form-control" accept=".pdf" required>
            <div class="invalid-feedback">Unggah file surat tugas dalam format PDF.</div>
        </div>

        <div class="mb-3">
            <label for="file_sertifikat" class="form-label">File Sertifikat (PDF)</label>
            <input type="file" id="file_sertifikat" name="file_sertifikat" class="form-control" accept=".pdf">
        </div>

        <div class="mb-3">
            <label for="foto_kegiatan" class="form-label">Foto Kegiatan (JPG, PNG, JPEG)</label>
            <input type="file" id="foto_kegiatan" name="foto_kegiatan" class="form-control" accept="image/jpeg, image/png" required>
            <div class="invalid-feedback">Unggah foto kegiatan dalam format JPG, PNG, atau JPEG.</div>
        </div>

        <div class="mb-3">
            <label for="file_poster" class="form-label">File Poster (JPG, PNG)</label>
            <input type="file" id="file_poster" name="file_poster" class="form-control" accept="image/jpeg, image/png">
        </div>

        <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
</div
