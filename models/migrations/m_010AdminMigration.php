<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_010AdminMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("admin", function (Blueprint $table) {
            $table->string("id",6);
            $table->string("id_user",6);
            $table->string("nip");
            $table->string("nama");
            $table->string("foto");
            $table->string("email");

            $table->primary("id");
            $table->unique("id");
        });
    }

    public function down(): array
    {
        return Schema::dropTableIfExist("admin");
    }
}
