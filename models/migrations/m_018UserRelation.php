<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_018UserRelation implements BaseMigration
{
    public function up(): array
    {
        return Schema::alterTable("user", function (Blueprint $table) {
            // Tabel user tidak memiliki foreign key berdasarkan diagram
            // Jika ada relasi tambahan, tambahkan di sini
        });
    }

    public function down(): array
    {
        return [];
    }
}
