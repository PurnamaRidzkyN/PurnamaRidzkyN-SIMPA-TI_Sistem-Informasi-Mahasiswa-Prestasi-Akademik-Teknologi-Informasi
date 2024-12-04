<?php

use app\models\BaseMigration;
use app\cores\Schema;
use app\cores\Blueprint;

class m_011UserMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("user", function (Blueprint $table) {
            $table->string("id",6);
            $table->string("username");
            $table->string("password");
            $table->tinyInt('role');

            $table->primary("id");
            $table->unique("username");
            $table->unique("id");
        });
    }

    public function down(): array
    {
        return Schema::dropTableIfExist("user");
    }
}
