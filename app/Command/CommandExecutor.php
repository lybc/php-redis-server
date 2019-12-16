<?php


namespace App\Command;


use Swoole\Table;

class CommandExecutor
{
    private static $commands = [];

    private function __construct()
    {
    }

    /**
     * 注册可用命令
     * @param AbstractRedisCommand $instance
     */
    public static function register(AbstractRedisCommand $instance)
    {
        self::$commands[$instance->name] = $instance;
    }

    /**
     * 执行命令
     * @param array $command
     * @return mixed
     * @throws \Exception
     */
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