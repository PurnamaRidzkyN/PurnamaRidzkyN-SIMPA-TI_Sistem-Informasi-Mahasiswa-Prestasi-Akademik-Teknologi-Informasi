<?php

use app\models\BaseMigration;
use app\cores\Schema;
use app\cores\Blueprint;

class m_001AdminMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("[user]", function (Blueprint $table) {
            $table->string("id");
            $table->string("username");
            $table->string("password");

            $table->primary("id");
            $table->unique("username");
            $table->unique("id");
            $table->tinyInt('role');
            $table->check('role', [1, 2, 3]);
        });
    }

    public function down(): array
    {
        return Schema::dropTableIfExist("[user]");
    }
}
