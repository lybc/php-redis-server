<?php
namespace App\Resp;

class Str implements RespDataType
{
    static function encode($val)
    {
        return "+" . $val . "\r\n";
    }

    static function decode(array $array, $size)
    {
        return $array[1];
    }
}