<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_020ViewLogDataView implements BaseMigration
{
    public function up(): array{
        return Schema::query("
        CREATE VIEW view_log_data AS
        SELECT 
            CASE
                WHEN a.id_user IS NOT NULL THEN a.nama
                WHEN m.id_user IS NOT NULL THEN m.nama
                ELSE 'Nama Tidak Ditemukan'
            END AS nama_user,
            ld.tabel_perubahan,
            ld.keterangan_kegiatan,
            ld.tanggal
        FROM 
            log_data ld
        LEFT JOIN 
            admin a ON ld.id_user = a.id_user
        LEFT JOIN 
            mahasiswa m ON ld.id_user = m.id_user;");
    }

    public function down(): array
    {
        return Schema::query("DROP VIEW view_log_data");
    }
}
