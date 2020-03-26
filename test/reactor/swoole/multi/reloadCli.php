<?php
require __DIR__.'/../../../../vendor/autoload.php';
use Ruantofly\IO\Reactor\Swoole\Mulit\Worker;
$host = "tcp://0.0.0.0:9000";

$server = new Worker($host);
// echo 1;
$server->onReceive = function($socket, $client, $data){
    (new Index)->index();
    send($client, "hello world client \n");
}; 
$server->reload();// 暂时只是停止子进程
