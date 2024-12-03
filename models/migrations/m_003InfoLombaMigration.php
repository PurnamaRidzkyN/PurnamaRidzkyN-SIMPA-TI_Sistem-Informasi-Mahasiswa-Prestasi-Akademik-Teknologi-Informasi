<?php


use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_003InfoLombaMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("info_lomba", function (Blueprint $table) {
            $table->int("id");
            $table->string("judul");
            $table->text("deskripsi_lomba");
            $table->date("tanggal_akhir_pendaftaran");
            $table->string("link_perlombaan");
            $table->string("file_poster");

            $table->primary("id");
        });
    }

    public function down(): array
    {
        return Schema::dropTableIfExist("info_lomba");
    }
}
