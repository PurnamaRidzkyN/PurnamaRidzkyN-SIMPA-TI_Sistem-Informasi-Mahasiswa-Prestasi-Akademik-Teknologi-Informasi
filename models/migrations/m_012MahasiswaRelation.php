<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_012MahasiswaRelation implements BaseMigration
{
    public function up(): array
    {
        return Schema::alterTable("mahasiswa", function (Blueprint $table) {
            $table->alterAddForeignKey("user_id", "user", "id", "FK_user_id_mahasiswa");
        });
    }

    public function down(): array
    {
        return Schema::alterTable("mahasiswa", function (Blueprint $table) {
            $table->alterDropConstraint("FK_user_id_mahasiswa");
        });
    }
}
