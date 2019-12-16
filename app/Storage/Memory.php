<?php
namespace App\Storage;

class Memory
{
    public static $volatile = [];

    public static function load()
    {
        self::$volatile = json_decode(file_get_contents('dump.rdb'), true);
    }

    public static function save()
    {
        file_put_contents('dump.rdb', json_encode(self::$volatile));
    }
}