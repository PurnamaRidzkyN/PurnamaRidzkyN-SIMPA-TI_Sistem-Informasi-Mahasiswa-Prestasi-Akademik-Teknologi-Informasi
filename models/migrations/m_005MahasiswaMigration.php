<?php


use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_005MahasiswaMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("mahasiswa", function (Blueprint $table) {
            $table->string("id",6);
            $table->string("id_user",6);
            $table->string("nama");
            $table->string("nim");
            $table->string("prodi");
            $table->string("tahun_masuk", 4);
            $table->string("total_skor");
            $table->string("foto");

            $table->primary("id");
        });
    }

    public function down(): array
    {
        return Schema::dropTableIfExist("mahasiswa");
    }
}
