<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;


class m_011DosenRelation implements BaseMigration
{
    public function up(): array
    {
        return Schema::alterTable("dosen", function (Blueprint $table) {
            $table->alterAddForeignKey("user_id", "user", "id", "Fk_user_id_dosen");
        });
    }

    public function down(): array
    {
      return Schema::alterTable("dosen", function (Blueprint $table) {
          $table->alterDropConstraint("FK_user_id_dosen");
      });
    }
}