<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_013LogDataRelation implements BaseMigration
{
    public function up(): array
    {
        return [
            Schema::alterTable("log_data", function (Blueprint $table) {
                // Relasi ke tabel user
                $table->alterAddForeignKey("id_user", "user", "id", "Fk_id_user_log_data");
            }),
        ];
    }

    public function down(): array
    {
        return [
            Schema::alterTable("log_data", function (Blueprint $table) {
                // Hapus relasi ke tabel user
                $table->alterDropConstraint("Fk_id_user_log_data");
            }),
        ];
    }
}
