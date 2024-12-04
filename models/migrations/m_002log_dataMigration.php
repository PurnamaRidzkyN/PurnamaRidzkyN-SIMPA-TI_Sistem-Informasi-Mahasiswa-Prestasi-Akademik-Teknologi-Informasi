<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_002log_dataMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("log_data", function (Blueprint $table) {
            $table->string("id",6);
            $table->string("id_user",6);
            $table->string("id_perubahan");
            $table->string("tabel_perubahan");
            $table->text("keterangan_kegiatan");
            $table->dateTime("tanggal");

            $table->primary("id");
            $table->unique("id");

        });
    }

    public function down(): array
    {
        return Schema::dropTableIfExist("log_data");
    }

}