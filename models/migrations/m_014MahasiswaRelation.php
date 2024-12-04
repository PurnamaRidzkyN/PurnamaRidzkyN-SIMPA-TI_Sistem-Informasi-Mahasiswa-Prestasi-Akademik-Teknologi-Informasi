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
            $table->alterAddForeignKey("user_id", "user", "id", "Fk_user_id_mahasiswa");
        });
    }

    public function down(): array
    {
        return Schema::alterTable("mahasiswa", function (Blueprint $table) {
            $table->alterDropConstraint("Fk_user_id_mahasiswa");
        });
    }
}
