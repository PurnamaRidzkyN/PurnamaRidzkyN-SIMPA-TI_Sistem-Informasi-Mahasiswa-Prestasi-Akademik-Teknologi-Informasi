<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_013LogDataRelation implements BaseMigration
{
    public function up(): array
    {
        return Schema::alterTable("log_data", function (Blueprint $table) {
            // Relasi ke tabel user
            $table->alterAddForeignKey("id_user", "user", "id", "FK_user_id_log_data");
        });
    }

    public function down(): array
    {
        return Schema::alterTable("log_data", function (Blueprint $table) {
            // Menghapus constraint foreign key
            $table->alterDropConstraint("FK_user_id_log_data");
        });
    }
}
