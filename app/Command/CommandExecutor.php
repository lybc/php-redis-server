<?php


namespace App\Command;


use Swoole\Table;

class CommandExecutor
{
    private static $commands = [];

    private function __construct()
    {
    }

    public static function register($command, $instance)
    {
        self::$commands[$command] = $instance;
    }

    public static function exec(array $command)
    {
        if (!isset(self::$commands[strtoupper($command[0])])) {
            throw new \Exception("ERR unknown command `{$command[0]}`");
        }

        $instance = self::$commands[strtoupper($command[0])];
        array_shift($command);
        return $instance->handle($command);
    }
}