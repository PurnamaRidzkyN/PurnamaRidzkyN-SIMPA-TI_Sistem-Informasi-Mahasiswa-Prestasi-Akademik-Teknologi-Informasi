<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_010AdminMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("admin", function (Blueprint $table) {
            $table->int("id");
            $table->int("user_id"); // Sesuai SQL, bisa null
            $table->string("nip");

            $table->primary("id");
        });
    }

    public function down(): array
    {
        return Schema::dropTableIfExist("admin");
    }
}
