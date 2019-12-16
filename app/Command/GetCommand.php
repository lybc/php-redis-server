<?php
namespace App\Command;

use App\Resp\BulkString;
use App\Resp\Error;
use App\Resp\Str;
use App\Storage\Memory;

class GetCommand extends AbstractRedisCommand
{
    public $name = 'GET';

    public function handle(array $params)
    {
        if (isset(Memory::$volatile[$params[0]])) {
            $result = Memory::$volatile[$params[0]];
            if (is_string($result)) {
                return Str::encode(Memory::$volatile[$params[0]]);
            }
            return Error::encode('WRONGTYPE Operation against a key holding the wrong kind of value');
        }
        return BulkString::nil();
    }
}