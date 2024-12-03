<?php

namespace app\models;

use app\cores\Database;

abstract class BaseModel extends Database
{
    protected static string $table;

    abstract protected function create();

    abstract protected function update();

    abstract protected function delete();

    abstract protected function read();

}