<?php
namespace App\Storage;

class Memory
{
    /**
     * @var \SplObjectStorage
     */
    public static $volatile = [];

    public static function load()
    {
        if (file_exists('dump.rdb')) {
            self::$volatile = unserialize(file_get_contents('dump.rdb'));
        }
    }

    public static function dump()
    {
        file_put_contents('dump.rdb', serialize(self::$volatile));
    }
}