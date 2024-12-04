<?php

namespace app\models;

use app\cores\Database;

abstract class BaseModel extends Database
{
    abstract public static function insert(array $data): array;
    abstract public static function deleteAll(): array;

}