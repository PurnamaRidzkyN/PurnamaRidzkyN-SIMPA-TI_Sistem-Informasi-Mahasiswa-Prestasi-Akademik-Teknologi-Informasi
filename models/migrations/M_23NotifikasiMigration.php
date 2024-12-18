<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_023NotifikasiMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("notifikasi", function (Blueprint $table) {
            $table->string("id",6);
            $table->string("id_user",6);
            $table->string("pesan");
            $table->string("tipe");
            $table->string("status");
            $table->string("dibuat");

            $table->primary("id");
            $table->unique("id");
        });
    }

    public function down(): array
    {
        return Schema::dropTableIfExist("notifikasi");
    }
}
