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
use app\controllers\PrestasiController;
use app\controllers\UserManagement;
use app\middlewares\AdminMiddleware;

use app\middlewares\StudentMiddleware;


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

$app::get("/dashboard/admin/:nip/log-data",[AuditLog::class,"renderWeb"],[AdminMiddleware::class]);
$app::post("/dashboard/admin/:nip/log-data",[AuditLog::class,"getFilteredLog"],[AdminMiddleware::class]);

$app::get("/dashboard/mahasiswa/:nim/prestasi",[PrestasiController::class,"renderListPrestasi"],[StudentMiddleware::class]);
$app::get("/dashboard/admin/:nip/prestasi",[PrestasiController::class,"renderListPrestasi"],[AdminMiddleware::class]);

$app::get("/dashboard/mahasiswa/:nim/upload-prestasi",[PrestasiController::class,"renderWeb"],[StudentMiddleware::class]);
$app::post("/dashboard/mahasiswa/:nim/submit-prestasi",[PrestasiController::class,"upload"],[StudentMiddleware::class]);

$app::get("/dashboard/admin/:nip/admin-data",[UserManagement::class,"renderDataAdmin"],[AdminMiddleware::class]);
$app::get("/dashboard/admin/:nip/mahasiswa-data", [UserManagement::class, "renderDataMahasiswa"], [AdminMiddleware::class]);
$app::get("/dashboard/admin/:nip/dosen-data", [UserManagement::class, "renderDataDosen"], [AdminMiddleware::class]);

$app::post("/dashboard/admin/:nip/admin-data/insert", [UserManagement::class, "insertAdminUsers"], [AdminMiddleware::class]);
$app::post("/dashboard/admin/:nip/mahasiswa-data/insert", [UserManagement::class, "insertMahasiswaUsers"], [AdminMiddleware::class]);
$app::post("/dashboard/admin/:nip/dosen-data/insert", [UserManagement::class, "insertDosenUsers"], [AdminMiddleware::class]);


$app::post("/dashboard/mahasiswa/:nim/detail-prestasi",[PrestasiController::class,"renderDetailPrestasi"],[StudentMiddleware::class]);
$app::post("/dashboard/admin/:nip/detail-prestasi",[PrestasiController::class,"renderDetailPrestasi"],[AdminMiddleware::class]);

$app::get("/dashboard/admin/:nip/manajemen-data",[ManagementData::class,"render"],[AdminMiddleware::class]);

$app::get("/dashboard/leaderboard", [Leaderboard::class,"renderLeaderboard"]);


$app::get("/logout", [Auth::class, "logout"]);
$app::run();