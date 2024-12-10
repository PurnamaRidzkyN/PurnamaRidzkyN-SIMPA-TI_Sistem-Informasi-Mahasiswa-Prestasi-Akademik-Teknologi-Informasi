<?php
use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_021ViewPrestasiView implements BaseMigration
{
    public function up(): array{
        return Schema::query("
CREATE VIEW view_prestasi AS
SELECT 
    j.id,    
    m.nama,
    m.nim,
    m.jurusan,
    m.prodi,
    m.tahun_masuk,
    p.peringkat,
    a.nama AS admin_nama,
    j.tim,
    j.judul_kompetisi,
    j.judul_kompetisi_en,
    j.tempat_kompetisi,
    j.tempat_kompetisi_en,
    j.url_kompetisi,
    j.tanggal_mulai,
    j.tanggal_akhir,
    j.jumlah_pt,
    j.jumlah_peserta,
    j.no_surat_tugas,
    j.tanggal_surat_tugas,
    j.file_surat_tugas,
    j.file_sertifikat,
    j.foto_kegiatan,
    j.file_poster,
    j.validasi,
    jl.jenis_lomba,
    tl.tingkat_lomba,
    ((tl.skor*2)+p.skor + j.jumlah_pt + j.jumlah_peserta )/10  AS skor
    d.nama as nama_dosen
FROM prestasi j
JOIN jenis_lomba jl ON jl.id = j.id_jenis_kompetisi
JOIN tingkat_lomba tl ON tl.id = j.id_tingkat_kompetisi
JOIN mahasiswa m ON m.id = j.id_mahasiswa
JOIN peringkat p ON p.id = j.id_peringkat
JOIN admin a ON a.id = j.id_admin
JOIN dosen_pembimbing dp On j.id = dp.id_prestasi
join dosen d on dp.id_dosen = d.id");
    }

    public function down(): array
    {
        return Schema::query("DROP VIEW view_prestasi");
    }
}

