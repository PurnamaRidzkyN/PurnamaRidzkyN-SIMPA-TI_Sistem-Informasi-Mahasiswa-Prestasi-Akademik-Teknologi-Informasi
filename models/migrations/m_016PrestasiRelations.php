<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_016PrestasiRelations implements BaseMigration
{
    public function up(): array
    {
        return [
            Schema::alterTable("prestasi", function (Blueprint $table) {
                // Relasi ke mahasiswa
                $table->alterAddForeignKey("id_mahasiswa", "mahasiswa", "id", "Fk_id_mahasiswa_prestasi");

                // Relasi ke jenis_lomba
                $table->alterAddForeignKey("id_jenis_lomba", "jenis_lomba", "id", "Fk_id_jenis_lomba_prestasi");

                // Relasi ke tingkat_lomba
                $table->alterAddForeignKey("id_tingkat_lomba", "tingkat_lomba", "id", "Fk_id_tingkat_lomba_prestasi");

                // Relasi ke peringkat
                $table->alterAddForeignKey("id_peringkat", "peringkat", "id", "Fk_id_peringkat_prestasi");
                $table->alterAddForeignKey("id_admin","admin","id","Fk_id_admin");
            }),
        ];
    }

    public function down(): array
    {
        return [
            Schema::alterTable("prestasi", function (Blueprint $table) {
                // Hapus relasi ke mahasiswa
                $table->alterDropConstraint("Fk_id_mahasiswa_prestasi");

                // Hapus relasi ke jenis_lomba
                $table->alterDropConstraint("Fk_id_jenis_kompetisi_prestasi");

                // Hapus relasi ke tingkat_lomba
                $table->alterDropConstraint("Fk_id_tingkat_kompetisi_prestasi");

                // Hapus relasi ke peringkat
                $table->alterDropConstraint("Fk_id_peringkat_prestasi");
            }),
        ];
    }
}
