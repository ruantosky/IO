<?php
// echo 1;
require __DIR__.'/../../../../vendor/autoload.php';
use Ruantofly\IO\Reactor\Swoole\Mulit\Worker;
$host = "tcp://0.0.0.0:9000";
$server = new Worker($host);
// echo 1;
$server->onReceive = function($socket, $client, $data){
    debug($data);
    send($client, "hello world client \n");
};
debug($host);
//debug(__DIR__);
$server->start();
 