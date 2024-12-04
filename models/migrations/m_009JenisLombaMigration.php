<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_009JenisLombaMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("jenis_lomba", function (Blueprint $table) {
            $table->string("id",6);
            $table->string("jenis_lomba");

            $table->primary("id");
        });
    }

    public function down(): array
    {
        return Schema::dropTableIfExist("jenis_lomba");
    }
}
