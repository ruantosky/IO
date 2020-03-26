<?php
// 是建立连接
$client = stream_socket_client("tcp://127.0.0.1:9000");
//非阻塞
stream_set_blocking($client, 0);
$new = time();
// 给socket通写信息
// 粗暴的方式去实现
//while (true) {
//    sleep(2);
//    fwrite($client, "hello world");
//    var_dump(fread($client, 65535));
//
//}

fwrite($client, "hello world");
var_dump(fread($client, 65535));


echo  "1111111111111\n";
echo time()-$new."\n";
// 定时检测是否接受到数据
//这种模型 会造成资源的消耗
$r = 0 ;
while(!feof($client)){
    var_dump(fread($client,65535));
    echo $r++."\n";
    sleep(1);
}