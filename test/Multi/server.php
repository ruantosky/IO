<?php
require __DIR__.'/../../vendor/autoload.php';
use Ruantofly\IO\Multi\Worker;
$host = "tcp://0.0.0.0:9000";
$server = new Worker($host);
$server->onConnect = function($socket, $client){
     echo "有一个连接进来了chuangjianlianjie\n";
     var_dump($client);
};
// 接收和处理信息
$server->onReceive = function($socket, $client, $data){
     echo "给连接发送信息fasongxiaoxi\n";
     sleep(10);
    $socket->send($client, "hello world client \n");
    // fwrite($client, "server hellow");
};
echo $host."Multi\n";
$server->start();
