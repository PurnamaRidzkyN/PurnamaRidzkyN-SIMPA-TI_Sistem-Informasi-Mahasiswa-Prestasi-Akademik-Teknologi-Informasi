<?php

use app\controllers\Auth;
use app\controllers\Home;
use app\cores\Database;
use app\cores\Router;
use app\constant\Config;
use app\controllers\Dashboard;
use app\middlewares\AdminMiddleware;
use app\middlewares\StudentMiddleware;

require_once "helpers/env.php";
require_once "vendor/autoload.php";

$db = new Database(Config::getConfig());

$app = new Router();
$app::get("/", [Home::class, "index"]);
$app::get("/login", [Auth::class, "renderLogin"]);
$app::post("/post-login", [Auth::class, "login"]);

$app::get("/dashboard/admin/:nip", [Dashboard::class, "adminDashboard"], [AdminMiddleware::class]);
$app::post("/logout", [Auth::class, "logout"]);
$app::run();