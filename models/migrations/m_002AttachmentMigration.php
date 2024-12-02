<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_002AttachmentMigration implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTableIfNotExist("log_data", function (Blueprint $table) {
            $table->string("id");
            $table->string("id_perubahan");
            $table->string("tabel_perubahan");
            $table->string("keterangan_kegatan");
            $table->string("tanggal");

            $table->primary("id");
            $table->unique("loa_id");
        });
    }

    public function down(): array
    {
        $query = [];

        $query[0] = Schema::alterTable("prestasi", function (Blueprint $table) {
            $table->alterDropConstraint("FK_prestasi_id");
        });
        $query[1] = Schema::dropTableIfExist("attachment");

        return $query;
    }

}