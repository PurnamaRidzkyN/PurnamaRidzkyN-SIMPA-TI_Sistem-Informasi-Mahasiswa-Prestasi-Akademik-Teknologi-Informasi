<?php
namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\models\database\logData\LogData;

class AuditLogController extends BaseController{

    public function logData():array{
        $data = LogData::displayLogData();
        return $data;
    }
    public function renderLogData(): void
    {
        $this->view("log/logData", "Log Data");
    }
}


