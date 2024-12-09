<?php

namespace app\controllers;

class ManagementData extends BaseController
{
    public function render(): void
    {
        $this->view("Dashboard/admin/manajemenData/manajemenData", "Manajemen Data");
    }
}