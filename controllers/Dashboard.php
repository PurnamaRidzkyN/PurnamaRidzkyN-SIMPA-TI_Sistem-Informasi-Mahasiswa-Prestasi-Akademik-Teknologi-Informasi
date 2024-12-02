<?php

namespace app\controllers;

use app\controllers\BaseController;

class Dashboard extends BaseController
{

    public function renderDashboard(): void
    {

        $this->view("dashboard/dashboard", ["title" => "dashboard"]);
    }
}
