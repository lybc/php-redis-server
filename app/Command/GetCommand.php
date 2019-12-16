<?php
namespace App\Command;

use App\Resp\Integer;
use App\Resp\Str;
use App\Storage\Memory;
use Swoole\Table;

class GetCommand extends AbstractRedisCommand
{
    protected $name = 'SET';

    public function handle(array $params)
    {
        if (isset(Memory::$volatile[$params[0]])) {
            return Str::encode(Memory::$volatile[$params[0]]);
        }
        return Str::encode(null);
    }
}