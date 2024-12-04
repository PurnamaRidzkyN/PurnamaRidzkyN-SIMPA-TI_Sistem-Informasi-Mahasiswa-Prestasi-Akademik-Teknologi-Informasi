<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_004DosenMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("dosen", function (Blueprint $table) {
            $table->string("id",6);
            $table->string("user_id",6); // Sesuai SQL, bisa null
            $table->string("nidn");
            $table->string("nama");

            $table->primary("id");
        });
    }

    public function down(): array
    {
        return Schema::dropTableIfExist("dosen");
    }
}
