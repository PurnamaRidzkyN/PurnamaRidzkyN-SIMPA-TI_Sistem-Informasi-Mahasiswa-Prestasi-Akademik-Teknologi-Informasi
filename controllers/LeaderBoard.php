<?php

namespace app\controllers;

use app\models\database\prestasiLomba\Peringkat;
use app\models\database\users\Mahasiswa;

class Leaderboard extends BaseController
{
    /**
     * Menampilkan leaderboard berdasarkan skor tertinggi.
     *
     * @return array
     */
    public static function getLeaderboard(): array
    {
        // Ambil semua data dari tabel peringkat, urutkan berdasarkan skor (descending).
        $peringkat = Peringkat::getAllSortedBySkor(); // ini error yaw

        // Gabungkan data peringkat dengan data mahasiswa berdasarkan ID Mahasiswa.
        $leaderboard = [];
        foreach ($peringkat as $entry) {
            $mahasiswa = Mahasiswa::findNim($entry[Peringkat::ID]);
            if ($mahasiswa) {
                $leaderboard[] = [
                    'nama' => $mahasiswa[Mahasiswa::NAMA],
                    'nim' => $mahasiswa[Mahasiswa::NIM],
                    'prodi' => $mahasiswa[Mahasiswa::PRODI],
                    'skor' => $entry[Peringkat::SKOR],
                    'peringkat' => $entry[Peringkat::PERINGKAT],
                ];
            }
        }

        return $leaderboard;
    }

    /**
     * Tambahkan entri baru ke leaderboard.
     *
     * @param array $data
     * @return array
     */
    public static function addLeaderboardEntry(array $data): array
    {
        // Data harus memiliki ID Mahasiswa, peringkat, dan skor.
        if (!isset($data[Peringkat::ID], $data[Peringkat::PERINGKAT], $data[Peringkat::SKOR])) {
            return ['status' => 'error', 'message' => 'Data tidak lengkap.'];
        }

        // Tambahkan ke tabel peringkat.
        return Peringkat::insert($data);
    }

    /**
     * Reset semua data leaderboard.
     *
     * @return array
     */
    public static function resetLeaderboard(): array
    {
        // Hapus semua data dari tabel peringkat.
        return Peringkat::deleteAll();
    }
}
