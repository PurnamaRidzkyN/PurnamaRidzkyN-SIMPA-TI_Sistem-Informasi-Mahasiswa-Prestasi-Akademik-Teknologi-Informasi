<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_024NotifRelation implements BaseMigration
{
    public function up(): array
    {
        return [
            Schema::alterTable("notifikasi", function (Blueprint $table) {
                // Relasi ke tabel user
                $table->alterAddForeignKey("id_user", "user", "id", "Fk_id_user_notifikasi");
            }),
        ];
    }

    public function down(): array
    {
        return [
            Schema::alterTable("notifikasi", function (Blueprint $table) {
                // Hapus relasi ke tabel user
                $table->alterDropConstraint("Fk_id_user_notifikasi");
            }),
        ];
    }
}
