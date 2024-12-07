<?php

namespace app\controllers;

use app\cores\Request;
use app\cores\Response;
use app\cores\Session;
use app\models\database\logData\LogData;

class AuditLog extends BaseController
{
private array  $data= [];
    public function getFilteredLog(Request $req, Response $res): void
    {
        $user = Session::get("user");
        $body = $req->body();
        if(is_null($body)){
            $this->displayLogData();
        }else{
            $data=$this->displayLogData($body);   
        }
        $res->redirect("/dashboard/admin/{$user}/log-data");
    }
    public function displayLogData($body=null):array{
        if (is_null($body)) {
            $this->data[] = LogData::logDataDisplay();
        } else {
            $this->data[] = LogData::getFilteredLogs($body);
        }
        
        return $this->data;
    }
    public function renderLogData(): void
    {
        $this->view("manajemenData/logData", "Log Data");
    }
}
