<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_017TingkatLombaRelation implements BaseMigration
{
    public function up(): array
    {
        return Schema::alterTable("tingkat_lomba", function (Blueprint $table) {
            // Tabel tingkat_lomba tidak memiliki foreign key dalam diagram
            // Jika nanti ada relasi tambahan, tambahkan di sini
        });
    }

    public function down(): array
    {
        return [];
    }
}
