<?php
use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_022HitungSkorTrigger implements BaseMigration
{
    public function up(): array{
        return Schema::createTriggerIfNotExist("prestasi","hitung_skor","
         IF EXISTS (SELECT 1 FROM inserted WHERE validasi = 1)
    BEGIN
        UPDATE mahasiswa
        SET total_skor = total_skor + (((tl.skor * 2) + (p.skor) + (i.jumlah_pt + i.jumlah_peserta)) / 10)
        FROM mahasiswa m
        INNER JOIN inserted i ON m.id = i.id_mahasiswa
        INNER JOIN tingkat_lomba tl ON tl.id = i.id_tingkat_kompetisi
        INNER JOIN peringkat p ON p.id = i.id_peringkat
        WHERE i.validasi = 1;
    END","UPDATE");
    }

    public function down(): array
    {
        return Schema::dropTriggerIfExist("hitung_skor");
    }
}
