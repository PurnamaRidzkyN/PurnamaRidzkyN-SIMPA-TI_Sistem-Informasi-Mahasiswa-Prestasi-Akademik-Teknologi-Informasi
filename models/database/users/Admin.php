<?php

namespace app\models\database\users;
use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseModel;
class Admin
{
    public const TABLE = "admin";
    public const ID = "id";
    public const ID_USER ="id_user";
    public const NIP = "nip";
    public const NAME = "name";
    public const EMAIL = "email";

    public static function insert(array $data): array
    {
        return Schema::insertInto(self::TABLE, function (Blueprint $table) use ($data) {
            $table->insert([self::ID,self::NIP,self::EMAIL], $data);
            
        });   
        
    }
    public static function findEmail($email) : array 
    {
        return Schema::selectWhereFrom(self::TABLE, function (Blueprint $table) use ($email) {
            $table->selectWhere(["email" => $email], [self::ID,self::ID_USER,self::NIP,self::EMAIL]);
        });   
    }
    
}