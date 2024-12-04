<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_017DosenPembimbingRelations implements BaseMigration
{
    public function up(): array
    {
        return Schema::alterTable("dosen_pembimbing", function (Blueprint $table) {
            // Relasi ke tabel dosen
            $table->alterAddForeignKey("id_dosen", "dosen", "id", "Fk_id_dosen_dosen_pembimbing");

            // Relasi ke tabel prestasi
            $table->alterAddForeignKey("id_prestasi", "prestasi", "id", "Fk_id_prestasi_dosen_pembimbing");
        });
    }

    public function down(): array
    {
        return Schema::alterTable("dosen_pembimbing", function (Blueprint $table) {
            // Hapus relasi ke tabel dosen    
            $table->alterDropConstraint("Fk_id_dosen_dosen_pembimbing");

            // Hapus relasi ke tabel prestasi
            $table->alterDropConstraint("Fk_id_prestasi_dosen_pembimbing");
        });
    }
}
