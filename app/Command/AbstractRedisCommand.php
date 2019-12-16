<?php


namespace App\Command;


use Swoole\Table;

abstract class AbstractRedisCommand
{
    protected $name;

    abstract public function handle(array $params);
}