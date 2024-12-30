<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_021ViewDosenPembimbingView implements BaseMigration
{
    public function up(): array
    {
        return Schema::query("
          CREATE VIEW view_dosen_pembimbing AS
            SELECT 
                dosen.nama AS nama,
                dosen_pembimbing.id_prestasi AS id
            FROM 
                dosen_pembimbing
            JOIN 
                dosen 
            ON 
                dosen.id = dosen_pembimbing.id_dosen;
        ");
    }

    public function down(): array
    {
        return Schema::query("
            DROP VIEW view_dosen_pembimbing;
        ");
    }
}
