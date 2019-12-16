<?php
namespace App\Command;

use App\Resp\BulkString;
use App\Resp\Integer;
use App\Resp\Str;
use App\Storage\Memory;
use Swoole\Table;

class LPopCommand extends AbstractRedisCommand
{
    public $name = 'LPOP';

    public function handle(array $params)
    {
        $key = $params[0];
        if (!isset(Memory::$volatile[$key])) {
            return BulkString::nil();
        }

        if (count(Memory::$volatile[$key]) > 0) {
            return Str::encode(array_pop(Memory::$volatile[$key]));
        }

        unset(Memory::$volatile[$key]);
        return BulkString::nil();
    }
}