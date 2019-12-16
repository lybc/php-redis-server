<?php
namespace App\Resp;

/**
 * Redis RESP协议 (Redis Serialization Protocol)
 * RESP协议支持5种数据类型：简单字符串(Simple Strings),错误数据(Errors),整数(Integers),批量字符串(Bulk Strings),数组(Arrays)
 *
 * 简单字符串以+开头
 * 错误数据以-开头
 * 整数以:开头
 * 批量字符串以$开头
 * 数组以*开头
 *
 * RESP协议的不同部分使用 "rn"（CRLF）进行分隔；
 */
interface RespDataType
{
    const FLAG_ARR = '*';
    const FLAG_STR = '+';
    const FLAG_BULK_STR = '$';
    const FLAG_ERROR = '-';
    const FLAG_INTEGER = ':';

    const FLAG_MAP = [
        self::FLAG_ARR => Arr::class,
        self::FLAG_STR => Str::class,
        self::FLAG_BULK_STR => BulkString::class,
        self::FLAG_ERROR => Error::class,
        self::FLAG_INTEGER => Integer::class,
    ];

    public static function encode($val);

    public static function decode(array $array, $size);
}