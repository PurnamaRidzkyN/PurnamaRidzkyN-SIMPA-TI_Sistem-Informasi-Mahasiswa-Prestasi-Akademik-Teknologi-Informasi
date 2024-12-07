<?php

namespace app\helpers;

class Dump
{

    public static function out(...$var)
    {
        echo "<pre>";
        foreach ($var as $v) {
            var_dump($v);
        }
        echo "</pre>";
    }
}