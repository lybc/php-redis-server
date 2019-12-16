<?php
namespace App\Command;

use App\Resp\Integer;
use App\Resp\Str;
use App\Storage\Memory;
use Swoole\Table;

class LPushCommand extends AbstractRedisCommand
{
    public $name = 'LPUSH';

    public function handle(array $params)
    {
        $key = $params[0];
        $list = Memory::$volatile[$params[0]] ?? [];
        unset($params[0]);
        foreach ($params as $item) {
            $list[] = $item;
        }
        Memory::$volatile[$key] = $list;
        return Integer::encode(count($list));
    }
}