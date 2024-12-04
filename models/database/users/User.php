<?php

namespace app\models\database\users;

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseModel;

class User extends BaseModel
{
    public const TABLE = "user";
    public const ID = "id";
    public const ROLE ="role";
    public const USERNAME = "username";
    public const PASSWORD = "password";

    public static function insert(array $data): array
    {
        return Schema::insertInto(self::TABLE, function (Blueprint $table) use ($data) {
            $table->insert([self::USERNAME, self::PASSWORD], $data);
            $table->insert([self::USERNAME, self::ROLE, self::PASSWORD], $data);
        });
    }
    public static function findOne(string $username): array
    {
        return Schema::selectWhereFrom(self::TABLE, function (Blueprint $table) use ($username) {
            $table->selectWhere(["username" => $username], [self::USERNAME, self::ROLE, self::PASSWORD]);
        });
    }
    public static function findAll(): array
    {
        return Schema::selectFrom(self::TABLE, function (Blueprint $table) {
            $table->select([self::USERNAME, self::ROLE, self::PASSWORD]);
        });
    }

    public static function deleteAll(): array
    {
        return Schema::deleteFrom(self::TABLE);
    }
}