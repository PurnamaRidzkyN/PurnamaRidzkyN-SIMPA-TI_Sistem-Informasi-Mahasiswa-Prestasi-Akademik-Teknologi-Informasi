<?php

namespace app\helpers;

use app\cores\Schema;


class UUID
{
    public static function generate($tableName, $prefix): string
    {
        try{
        $currentId = Schema::query("SELECT TOP 1 id
        FROM $tableName
        WHERE id LIKE '$prefix%'
        ORDER BY id DESC;");
        $id =$currentId['result'][0]['id'];
        if (is_null($id)){
            $id = $prefix."000";
        } 
        $prefix = preg_replace('/\d+/', '', $id); 
        $number = preg_replace('/\D+/', '', $id); 
        
        $newNumber = (int)$number + 1;
        
        $formattedNumber = str_pad($newNumber, strlen($number), '0', STR_PAD_LEFT);
      
        return $prefix . $formattedNumber;
    }catch (\PDOException $e) {
        var_dump($e->getMessage());
    }
}
    }

