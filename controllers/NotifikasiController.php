<?php

use app\controllers\BaseController;
use app\cores\Request;
use app\cores\Response;

class NotifikasiController extends BaseController{
    public function renderNotifikasi(Request $req ,Response $res ) : void {
        $this->view("home/home", "notifikasi");
        
    }
}