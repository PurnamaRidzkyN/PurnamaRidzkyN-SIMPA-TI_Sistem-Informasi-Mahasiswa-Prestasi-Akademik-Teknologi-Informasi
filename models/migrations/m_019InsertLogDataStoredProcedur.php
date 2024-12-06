<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_019insertLogDataStoredProcedur implements BaseMigration
{
    public function up(): array
    {
        return Schema::query("
        CREATE PROCEDURE sp_LogData
            @id NVARCHAR(6),
            @id_user VARCHAR(6),
            @id_perubahan VARCHAR(6),
            @tabel_perubahan VARCHAR(6),
            @jenis_operasi VARCHAR(10),
            @kolom_perubahan VARCHAR(255) = NULL,
            @data_lama TEXT = NULL,
            @data_baru TEXT = NULL
        AS
        BEGIN
            SET NOCOUNT ON;

            DECLARE @keterangan_kegiatan NVARCHAR(MAX);

            -- Generate keterangan berdasarkan jenis operasi
            SET @keterangan_kegiatan = CASE 
                WHEN @jenis_operasi = 'INSERT' THEN CONCAT('Menambahkan data baru ke tabel ', @tabel_perubahan, '. Data: ', @data_baru)
                WHEN @jenis_operasi = 'UPDATE' THEN CONCAT('Menggantikan data ', @data_lama, ' di kolom ', @kolom_perubahan, ' dengan data ', @data_baru, ' di tabel ', @tabel_perubahan)
                WHEN @jenis_operasi = 'DELETE' THEN CONCAT('Menghapus data ', @data_lama, ' dari tabel ', @tabel_perubahan)
                ELSE 'Operasi tidak dikenal.'
            END;

            -- Insert log ke tabel log_data
            INSERT INTO log_data (id, id_user, id_perubahan, tabel_perubahan, keterangan_kegiatan)
            VALUES (@id, @id_user, @id_perubahan, @tabel_perubahan, @keterangan_kegiatan);

            PRINT 'Log telah berhasil disimpan.';
        END;

        ");
    }

    public function down(): array
    {
        return Schema::query("
            IF EXISTS (
                SELECT * 
                FROM sysobjects
                WHERE name = 'sp_LogData' AND type = 'P'
            )
            BEGIN
                DROP PROCEDURE sp_LogData;
            END;
        ");
    }
}
