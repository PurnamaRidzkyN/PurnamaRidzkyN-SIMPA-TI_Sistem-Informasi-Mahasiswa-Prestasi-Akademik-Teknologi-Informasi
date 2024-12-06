<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_018GetLeaderboardStoredProcedur implements BaseMigration
{
    public function up(): array
    {
        return Schema::query("
            IF NOT EXISTS (
                SELECT * 
                FROM sysobjects
                WHERE name = 'sp_GetLeaderboardByProdi' AND type = 'P'
            )
            BEGIN
                EXEC('
                    CREATE PROCEDURE sp_GetLeaderboardByProdi
                        @Prodi NVARCHAR(255) -- Parameter untuk memfilter Program Studi
                    AS
                    BEGIN
                        SET NOCOUNT ON;

                        SELECT TOP 10
                            m.nama AS Nama_Mahasiswa,
                            m.nim AS NIM,
                            m.prodi AS Program_Studi,
                            CAST(m.total_skor AS INT) AS Total_Skor, -- Pastikan tipe data sesuai
                            COUNT(p.id) AS Jumlah_Kompetisi
                        FROM
                            dbo.mahasiswa m
                        LEFT JOIN
                            dbo.prestasi p ON p.id_mahasiswa = m.id
                        WHERE
                            m.prodi = @Prodi -- Filter berdasarkan Program Studi
                        GROUP BY
                            m.id, m.nama, m.nim, m.prodi, m.total_skor
                        ORDER BY
                            CAST(m.total_skor AS INT) DESC, -- Urut berdasarkan total_skor
                            Jumlah_Kompetisi DESC;
                    END;
                ');
            END;
        ");
    }

    public function down(): array
    {
        return Schema::query("
            DROP PROCEDURE sp_GetLeaderboardByProdi;
        ");
    }
}
