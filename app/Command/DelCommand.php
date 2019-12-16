<?php
namespace App\Command;

use App\Resp\Integer;
use App\Resp\Str;
use App\Storage\Memory;
use Swoole\Table;

class DelCommand extends AbstractRedisCommand
{
    public $name = 'DEL';

    public function handle(array $params)
    {
        $key = $params[0];
        if (isset(Memory::$volatile[$key])) {
            unset(Memory::$volatile[$key]);
            return Integer::encode(1);
        }
        return Integer::encode(0);
    }
}