<?php

use app\controllers\Auth;
use app\controllers\Home;
use app\cores\Database;
use app\cores\Router;
use app\constant\Config;
use app\controllers\AuditLog;
use app\controllers\NewPassword;
use app\controllers\Dashboard;
use app\controllers\Leaderboard;
use app\controllers\ManagementData;
use app\controllers\ManagementDataController;
use app\controllers\NotifikasiController;
use app\controllers\PrestasiController;
use app\controllers\UserManagement;
use app\middlewares\AdminMiddleware;
use app\middlewares\DosenMiddleware;
use app\middlewares\StudentMiddleware;
use app\models\database\users\Dosen;

require_once "helpers/env.php";
require_once "vendor/autoload.php";

$db = new Database(Config::getConfig());

$app = new Router();
$app::get("/", [Home::class, "index"]);

$app::get("/login", [Auth::class, "renderLogin"]);
$app::post("/post-login", [Auth::class, "login"]);

$app::get("/forgot-password",[NewPassword::class,"renderForgotPassword"]);
$app::post("/send-password",[NewPassword::class,"handleForgotPassword"]);

$app::get("/change-password",[NewPassword::class,"renderChangePassword"]);

$app::post("/change-password/new-password",[NewPassword::class,"changePassword"]);

$app::get("/dashboard/admin/:nip", [Dashboard::class, "adminDashboard"], [AdminMiddleware::class]);
$app::get("/dashboard/mahasiswa/:nim", [Dashboard::class, "studentDashboard"],[StudentMiddleware::class]);

$app::get("/dashboard/mahasiswa/:nim", [Dashboard::class, "studentDashboard"],[StudentMiddleware::class]);
$app::get("/dashboard/dosen/:nidn", [Dashboard::class, "studentDashboard"],[DosenMiddleware::class]);


$app::get("/dashboard/mahasiswa/:nim/notifikasi", [Dashboard::class, "renderNotifikasiMahasiswa"],[StudentMiddleware::class]);
$app::get("/dashboard/admin/:nip/notifikasi", [Dashboard::class, "renderNotifikasiAdmin"],[AdminMiddleware::class]);

$app::post("/notifikasi/delete", [NotifikasiController::class, "deleteNotifikasi"]);
$app::post("/notifikasi", [NotifikasiController::class, "changeStatusNotifikasi"]);

$app::get("/dashboard/admin/:nip/profil", [Dashboard::class, "renderProfilAdmin"], [AdminMiddleware::class]);
$app::get("/dashboard/mahasiswa/:nim/profil", [Dashboard::class, "renderProfilMahasiswa"], [StudentMiddleware::class]);
$app::get("/dashboard/dosen/:nidn/profil", [Dashboard::class, "renderProfilDosen"], [DosenMiddleware::class]);


$app::get("/dashboard/admin/:nip/daftar-mahasiswa",[PrestasiController::class,"renderDaftarMahasiswa"],[AdminMiddleware::class]);


$app::get("/dashboard/mahasiswa/:nim/prestasi",[PrestasiController::class,"renderListPrestasi"],[StudentMiddleware::class]);
$app::post("/dashboard/admin/:nip/prestasi",[PrestasiController::class,"renderListPrestasi"],[AdminMiddleware::class]);
$app::get("/dashboard/dosen/:nidn/prestasi",[PrestasiController::class,"renderListPrestasiDosen"],[DosenMiddleware::class]);

$app::get("/dashboard/mahasiswa/:nim/upload-prestasi",[PrestasiController::class,"renderWeb"],[StudentMiddleware::class]);
$app::post("/dashboard/mahasiswa/:nim/submit-prestasi",[PrestasiController::class,"upload"],[StudentMiddleware::class]);

$app::post("/dashboard/mahasiswa/:nim/detail-prestasi",[PrestasiController::class,"renderDetailPrestasi"],[StudentMiddleware::class]);
$app::post("/dashboard/admin/:nip/detail-prestasi",[PrestasiController::class,"renderDetailPrestasi"],[AdminMiddleware::class]);
$app::post("/dashboard/Dosen/:nidn/detail-prestasi",[PrestasiController::class,"renderDetailPrestasi"],[DosenMiddleware::class]);


$app::post("/dashboard/admin/:nip/detail-prestasi/validate",[PrestasiController::class,"validatePrestasi"],[AdminMiddleware::class]);


$app::get("/dashboard/admin/:nip/manajemen-data",[ManagementData::class,"renderManagementData"],[AdminMiddleware::class]);
$app::post("/dashboard/admin/:nip/manajemen-data",[ManagementData::class,"renderManagementData"],[AdminMiddleware::class]);
$app::post("/dashboard/admin/:nip/manajemen-data/manipulate-data", [ManagementDataController::class, "manageData"], [AdminMiddleware::class]);

$app::get("/leaderboard", [Leaderboard::class,"renderLeaderboard"]);
$app::get("/leaderboard/all", [Leaderboard::class,"renderLeaderboardAll"]);
$app::get("/leaderboard/LeaderboardSIB", [Leaderboard::class,"renderLeaderboardSIB"]);
$app::get("/leaderboard/LeadearboardTI", [Leaderboard::class,"renderLeaderboardTI"]);


$app::get("/logout", [Auth::class, "logout"]);
$app::run();