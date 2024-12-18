<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_005TingkatLombaMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("tingkat_lomba", function (Blueprint $table) {
            $table->string("id",6);
            $table->string("tingkat_lomba");
            $table->int("skor");

            $table->primary("id");
            $table->unique("id");
        });
    }

    public function down(): array
    {
        return Schema::dropTableIfExist("tingkat_lomba");
    }
}