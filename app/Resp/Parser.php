<?php
namespace App\Resp;

class Parser
{

    public static function command($command)
    {
        $items = array_filter(explode("\r\n", $command));
        $size = substr($items[0], 1);
        array_shift($items);
        return Arr::decode($items, $size);
    }
}