<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\helpers\Dump;
use app\models\database\logData\LogData;

class AuditLog extends BaseController
{
    public function getFilteredLog(Request $req, Response $res): void
    {
        $body = $req->body();
        try{
        if(!empty($body)){        
            $data=LogData::getFilteredLogs($body);     
        } 
        $this->view("dashboard/admin/manajemenData/logData", "Log Data",$data);
        }catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function renderWeb(){
        $data=LogData::logDataDisplay();
        $this->view("dashboard/admin/manajemenData/logData", "Log Data",$data);
    }

}
