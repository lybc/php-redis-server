<?php


namespace App\Command;


use Swoole\Table;

abstract class AbstractRedisCommand
{
    public $name;

    abstract public function handle(array $params);
}