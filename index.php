<?php

use app\controllers\Auth;
use app\controllers\Home;
use app\cores\Database;
use app\cores\Router;
use app\constant\Config;
use app\middlewares\AuthMiddleware;
use app\controllers\Dashboard;

require_once "helpers/env.php";
require_once "vendor/autoload.php";

$db = new Database(Config::getConfig());

$app = new Router();

$app::get("/", [Home::class, "index"], [AuthMiddleware::class]);
$app::get("/login", [Auth::class, "renderLogin"]);
$app::post("/post-login", [Auth::class, "login"]);

$app::get("/dashboard", [Dashboard::class, "renderDashboard"]);

$app::run();
