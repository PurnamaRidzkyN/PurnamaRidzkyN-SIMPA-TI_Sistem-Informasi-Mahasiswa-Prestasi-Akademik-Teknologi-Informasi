<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_014DetailPrestasiRelation implements BaseMigration
{
    public function up(): array
    {
        return Schema::alterTable("detail_prestasi", function (Blueprint $table) {
            // Relasi ke tabel jenis_lomba
            $table->alterAddForeignKey("id_jenis_kompetisi", "jenis_lomba", "id", "FK_jenis_lomba_id_detail_prestasi");

            // Relasi ke tabel tingkat_lomba
            $table->alterAddForeignKey("id_tingkat_kompetisi", "tingkat_lomba", "id", "FK_tingkat_lomba_id_detail_prestasi");

            // Relasi ke tabel mahasiswa
            $table->alterAddForeignKey("id_mahasiswa", "mahasiswa", "id", "FK_mahasiswa_id_detail_prestasi");

            // Relasi ke tabel dosen
            $table->alterAddForeignKey("id_dosen", "dosen", "id", "FK_dosen_id_detail_prestasi");

            // Relasi ke tabel peringkat
            $table->alterAddForeignKey("id_peringkat", "peringkat", "id", "FK_peringkat_id_detail_prestasi");
        });
    }

    public function down(): array
    {
        return Schema::alterTable("detail_prestasi", function (Blueprint $table) {
            // Menghapus constraint foreign key
            $table->alterDropConstraint("FK_jenis_lomba_id_detail_prestasi");
            $table->alterDropConstraint("FK_tingkat_lomba_id_detail_prestasi");
            $table->alterDropConstraint("FK_mahasiswa_id_detail_prestasi");
            $table->alterDropConstraint("FK_dosen_id_detail_prestasi");
            $table->alterDropConstraint("FK_peringkat_id_detail_prestasi");
        });
    }
}
