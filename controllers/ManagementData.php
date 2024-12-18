<?php

namespace app\controllers;

use app\helpers\Dump;
use app\models\database\logData\LogData;
use app\models\database\users\Mahasiswa;

class ManagementData extends BaseController
{
    public function render(): void
    {   
       $log = LogData::logDataDisplay();
        $log = $log["result"];
        if (is_null($log)){
            $this->view("Dashboard/admin/manajemenData/manajemenData", "Manajemen Data");

        }
        $this->view("Dashboard/admin/manajemenData/manajemenData", "Manajemen Data",$log);
    }
}