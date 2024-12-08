<?php

namespace app\controllers;

use app\cores\Schema;
use app\models\database\prestasiLomba\Prestasi;
use app\models\database\prestasiLomba\TingkatLomba;
use app\models\database\prestasiLomba\JenisLomba;
use app\models\database\prestasiLomba\Peringkat;

class ManipulationData extends BaseController
{
    /**
     * Insert data Prestasi
     */
    public static function insertPrestasi(array $data): array
    {
        try {
            return Prestasi::insert($data);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Insert data Tingkat Lomba
     */
    public static function insertTingkatLomba(array $data): array
    {
        try {
            return TingkatLomba::insert($data);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Insert data Jenis Lomba
     */
    public static function insertJenisLomba(array $data): array
    {
        try {
            return JenisLomba::insert($data);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Insert data Peringkat
     */
    public static function insertPeringkat(array $data): array
    {
        try {
            return Peringkat::insert($data);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Delete all Prestasi records
     */
    public static function deleteAllPrestasi(): array
    {
        try {
            return Prestasi::deleteAll();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Delete all Tingkat Lomba records
     */
    public static function deleteAllTingkatLomba(): array
    {
        try {
            return TingkatLomba::deleteAll();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Delete all Jenis Lomba records
     */
    public static function deleteAllJenisLomba(): array
    {
        try {
            return JenisLomba::deleteAll();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Delete all Peringkat records
     */
    public static function deleteAllPeringkat(): array
    {
        try {
            return Peringkat::deleteAll();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Example function to retrieve and display records (if needed for manipulation)
     * This assumes a method like `Schema::select()` exists.
     */
    public static function getPrestasiById(int $id)
    {
        try {
            return Schema::selectFrom(Prestasi::TABLE, "*", [Prestasi::ID => $id]);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function renderManipulation(): void
    {
        $this->view("Manipulation/ManipulasiData", "Manipulasi Data");
    }
}

?>
