<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_004DosenMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("dosen", function (Blueprint $table) {
            $table->int("id");
            $table->int("user_id"); // Sesuai SQL, bisa null
            $table->string("nip");
            $table->string("nama");

            $table->primary("id");
        });
    }

    public function down(): array
    {
        return Schema::dropTableIfExist("dosen");
    }
}
