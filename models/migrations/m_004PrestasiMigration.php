<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_004PrestasiMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("prestasi", function (Blueprint $table) {
            $table->string("id",6);
            $table->string("id_jenis_kompetisi",6);
            $table->string("id_tingkat_kompetisi",6);
            $table->string("id_mahasiswa",6);
            $table->string("id_peringkat",6);
            $table->string("id_admin",6);
            $table->tinyInt("tim");
            $table->string("judul_kompetisi");
            $table->string("judul_kompetisi_en");
            $table->string("tempat_kompetisi");
            $table->string("tempat_kompetisi_en");
            $table->string("url_kompetisi");
            $table->date("tanggal_mulai");
            $table->date("tanggal_akhir");
            $table->int("jumlah_pt");
            $table->int("jumlah_peserta");
            $table->string("no_surat_tugas");
            $table->date("tanggal_surat_tugas");
            $table->string("file_surat_tugas");
            $table->string("file_sertifikat");
            $table->string("foto_kegiatan");
            $table->string("file_poster");
            $table->tinyInt("validasi");
            $table->datetime("tanggal_input");

            $table->primary("id");
            $table->unique("id");
            
        });
    }

    public function down(): array
    {
        return Schema::dropTableIfExist("prestasi");
    }
}
