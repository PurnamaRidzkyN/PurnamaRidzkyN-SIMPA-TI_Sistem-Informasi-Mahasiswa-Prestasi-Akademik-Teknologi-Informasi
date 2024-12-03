<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_016PeringkatRelation implements BaseMigration
{
    public function up(): array
    {
        return Schema::alterTable("peringkat", function (Blueprint $table) {
            // Tabel peringkat tidak memiliki foreign key dalam diagram
            // Jika nanti ada relasi tambahan, tambahkan di sini
        });
    }

    public function down(): array
    {
        return [];
    }
}
