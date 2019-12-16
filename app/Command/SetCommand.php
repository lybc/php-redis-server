<?php
namespace App\Command;

use App\Resp\Integer;
use App\Resp\Str;
use App\Storage\Memory;
use Swoole\Table;

class SetCommand extends AbstractRedisCommand
{
    protected $name = 'SET';

    public function handle(array $params)
    {
        Memory::$volatile[$params[0]] = $params[1];
        return Str::encode('ok');
    }
}