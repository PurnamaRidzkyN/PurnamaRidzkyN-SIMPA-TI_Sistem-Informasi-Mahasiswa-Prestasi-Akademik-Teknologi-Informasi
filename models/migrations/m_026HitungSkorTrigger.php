<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_026HitungSkorTrigger implements BaseMigration
{
    public function up(): array
    {
        return Schema::createTriggerIfNotExist("prestasi", "hitung_skor", "
                         
IF EXISTS (
            SELECT 1 
            FROM inserted i
            WHERE i.validasi = 1
            AND EXISTS (SELECT 1 FROM deleted d WHERE d.validasi != i.validasi)
        )
        BEGIN
            -- Update total_skor pada mahasiswa berdasarkan view_prestasi
            UPDATE m
            SET m.total_skor = m.total_skor + vp.skor
            FROM mahasiswa m
            INNER JOIN inserted i ON m.id = i.id_mahasiswa
            INNER JOIN view_prestasi vp ON vp.id = i.id
            WHERE i.validasi = 1; 
        END", "UPDATE");
    }

    public function down(): array
    {
        return Schema::dropTriggerIfExist("hitung_skor");
    }
}
