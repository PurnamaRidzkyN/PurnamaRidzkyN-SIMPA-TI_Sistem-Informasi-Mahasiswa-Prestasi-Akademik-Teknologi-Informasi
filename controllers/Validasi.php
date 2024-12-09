<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\models\database\users\Admin;
use app\models\database\prestasiLomba\Prestasi;

class Validasi extends BaseController
{
    /**
     * Validasi prestasi mahasiswa oleh dosen.
     *
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function validatePrestasi(Request $request, Response $response)
    {
        // Ambil data dari request
        $data = $request->Body();

        // Validasi input
        if (!isset($data['id_prestasi'], $data['id_dosen'], $data['validasi'])) {
            return $this->view("validasi/error", "validasi", [
                "error" => "Data tidak lengkap. Pastikan semua input telah diisi."
            ]);
        }

        $idPrestasi = $data['id_prestasi'];
        $validasiStatus = $data['validasi']; // "valid" atau "tidak valid"
        $admin = Admin::findNip(Session::get("user"));

        // Update validasi prestasi
        $updateValidasi = Prestasi::updatePrestasi($validasiStatus, Prestasi::ID, $idPrestasi);
        $updateAdmin = Prestasi::updateIdAdmin($admin['result'][0]["id_user"], Prestasi::ID, $idPrestasi);

        if ($updateValidasi['success'] && $updateAdmin['success']) {
            return $this->view("validasi/success", "validasi", [
                "message" => "Prestasi mahasiswa berhasil divalidasi."
            ]);
        }

        return $this->view("validasi/error", "validasi", [
            "error" => "Terjadi kesalahan saat memvalidasi prestasi mahasiswa."
        ]);
    }
}
