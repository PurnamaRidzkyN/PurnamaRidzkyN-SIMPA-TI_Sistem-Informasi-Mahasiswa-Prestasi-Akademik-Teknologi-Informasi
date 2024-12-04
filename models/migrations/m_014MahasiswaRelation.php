<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_014MahasiswaRelation implements BaseMigration
{
    public function up(): array
    {
        return Schema::alterTable("mahasiswa", function (Blueprint $table) {
            //relasi mahasiswa dengan tabel user
            $table->alterAddForeignKey("id_user", "user", "id", "Fk_id_user_mahasiswa");
        });
    }

    public function down(): array
    {
        return Schema::alterTable("mahasiswa", function (Blueprint $table) {
            $table->alterDropConstraint("Fk_id_user_mahasiswa");
        });
    }
}
