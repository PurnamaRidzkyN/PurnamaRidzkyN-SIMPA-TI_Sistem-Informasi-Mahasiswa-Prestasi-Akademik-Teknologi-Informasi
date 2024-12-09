<?php

namespace app\controllers;

use app\models\database\users\Mahasiswa;
use app\models\database\prestasiLomba\Peringkat;

class Leaderboard extends BaseController
{
    /**
     * Menampilkan leaderboard mahasiswa berdasarkan total skor.
     *
     * @return array
     */
    public static function getLeaderboard(): array
    {
        // Ambil data mahasiswa
        $mahasiswa = Mahasiswa::findAll();
        
        // Jika tidak ada data mahasiswa, kembalikan array kosong
        if (empty($mahasiswa)) {
            return [];
        }

        // Urutkan mahasiswa berdasarkan total skor secara descending
        usort($mahasiswa, function ($a, $b) {
            return $b['total_skor'] - $a['total_skor'];
        });

        // Buat leaderboard dengan format data yang diperlukan
        $leaderboard = [];
        $peringkat = 1;

        foreach ($mahasiswa as $mhs) {
            $leaderboard[] = [
                'peringkat' => $peringkat++,
                'nama' => $mhs['nama'],
                'nim' => $mhs['nim'],
                'prodi' => $mhs['prodi'],
                'jurusan' => $mhs['jurusan'],
                'tahun_masuk' => $mhs['tahun_masuk'],
                'total_skor' => $mhs['total_skor'],
            ];
        }

        return $leaderboard;
    }

    /**
     * Menghapus seluruh data leaderboard.
     *
     * @return array
     */
    public static function resetLeaderboard(): array
    {
        $resultMahasiswa = Mahasiswa::deleteAll();
        $resultPeringkat = Peringkat::deleteAll();

        return [
            'mahasiswa_deleted' => $resultMahasiswa,
            'peringkat_deleted' => $resultPeringkat,
        ];
    }

    /**
     * Tambahkan data mahasiswa dan skor ke leaderboard.
     *
     * @param array $mahasiswaData
     * @param array $peringkatData
     * @return array
     */
    public static function addToLeaderboard(array $mahasiswaData, array $peringkatData): array
    {
        $resultMahasiswa = Mahasiswa::insert($mahasiswaData);
        $resultPeringkat = Peringkat::insert($peringkatData);

        return [
            'mahasiswa_added' => $resultMahasiswa,
            'peringkat_added' => $resultPeringkat,
        ];
    }

    public function renderViewLomba(): void
    {
        $this->view("dashboard/leaderboard/Leaderboard", "Leaderboard");
    }
}
