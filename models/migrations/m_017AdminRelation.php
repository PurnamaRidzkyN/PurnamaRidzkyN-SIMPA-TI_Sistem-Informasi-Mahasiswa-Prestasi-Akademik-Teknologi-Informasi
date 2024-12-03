<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;


class m_017AdminRelation implements BaseMigration
{
    public function up(): array
    {
        return Schema::alterTable("dosen", function (Blueprint $table) {
            $table->alterAddForeignKey("user_id", "user", "id", "Fk_user_id_admin");
        });
    }

    public function down(): array
    {
      return Schema::alterTable("dosen", function (Blueprint $table) {
          $table->alterDropConstraint("FK_user_id_admin");
      });
    }
}