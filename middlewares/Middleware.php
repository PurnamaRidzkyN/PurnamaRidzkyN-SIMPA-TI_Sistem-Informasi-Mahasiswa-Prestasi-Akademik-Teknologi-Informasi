<?php

namespace app\middlewares;

use app\cores\Request;
use app\cores\Response;
interface Middleware
{
    public function before(Request $req, Response $res);
}