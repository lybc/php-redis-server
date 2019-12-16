<?php
namespace App\Resp;

class Integer implements RespDataType
{
    static function encode($val)
    {
        return ":" . $val . "\r\n";
    }

    static function decode(array $array, $size)
    {
        return (int)$array[1];
    }
}