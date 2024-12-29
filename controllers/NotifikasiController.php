<?php

use app\controllers\BaseController;
use app\cores\Request;
use app\cores\Response;
use app\models\database\users\Notifikasi;

class NotifikasiController extends BaseController{
    public function renderNotifikasi(Request $req ,Response $res ) : void {
        $data = Notifikasi::displayNotif();
        
        $this->view("home/home", "notifikasi",$data);
        
    }
}