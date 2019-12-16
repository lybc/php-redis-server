<?php
require_once "vendor/autoload.php";

use App\Command\CommandExecutor;
use App\Command\DelCommand;
use App\Command\GetCommand;
use App\Command\LPopCommand;
use App\Command\LPushCommand;
use App\Command\SetCommand;
use App\Resp\Parser;
use App\Storage\Memory;
use Swoole\Server;
use Swoole\Timer;

$server = new Server('0.0.0.0', 10086, SWOOLE_PROCESS, SWOOLE_SOCK_TCP);
$server->set([
    'worker_num' => 1,
//    'daemonize' => true,
    'backlog' => 128
]);

$server->on('WorkerStart', function ($server, $worker_id) {
    CommandExecutor::register(new SetCommand());
    CommandExecutor::register(new GetCommand());
    CommandExecutor::register(new LPushCommand());
    CommandExecutor::register(new LPopCommand());
    CommandExecutor::register(new DelCommand());

    // 服务启动时，将rdb文件加载到内存中

    Memory::load();
    // 启动定时器将内存数据存储到rdb文件中
    Timer::tick(10000, function () {
        echo sprintf("[%s] 定时器执行\n", date('Y-m-d H:i:s'));
        Memory::dump();
    });
});

$server->on('connect', function ($server, $fd) {
    echo "Client[{$fd}]: Connected\n";
});

$server->on('close', function ($server, $fd) {
    echo "Client[{$fd}]: Closed\n";
});


$server->on('receive', function ($server, $fd, $react_id, $data) {
    $command = Parser::command($data);
    try {
        $server->send($fd, CommandExecutor::exec($command));
    } catch (Exception $e) {
        $server->send($fd, \App\Resp\Error::encode($e->getMessage()));
    }
});

$server->start();

