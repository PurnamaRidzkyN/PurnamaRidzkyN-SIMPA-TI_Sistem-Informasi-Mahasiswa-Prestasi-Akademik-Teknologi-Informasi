<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_007DosenMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("dosen", function (Blueprint $table) {
            $table->string("id",6);
            $table->string("id_user",6);
            $table->string("nidn");
            $table->string("nama");
            $table->string("email");
            $table->string("foto");

            $table->primary("id");
            $table->unique("id");
        });
    }

    public function down(): array
    {
        return Schema::dropTableIfExist("dosen");
    }
}
