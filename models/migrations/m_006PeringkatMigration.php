<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_006PeringkatMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("peringkat", function (Blueprint $table) {
            $table->string("id",6);
            $table->int("peringkat");
            $table->int("skor");

            $table->primary("id");
        });
    }

    public function down(): array
    {
        return Schema::dropTableIfExist("peringkat");
    }
}
