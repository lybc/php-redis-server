<?php
namespace App\Resp;

class BulkString implements RespDataType
{
    public static function nil()
    {
        return "$-1\r\n";
    }

    static function encode($val)
    {
        return "$" . strlen($val) . "\r\n" . $val . "\r\n";
    }

    static function decode(array $array, $size)
    {
        if (substr($array[0], 1) > 0) {
            return $array[1];
        }
        return null;
    }
}