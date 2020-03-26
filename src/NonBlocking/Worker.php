<?php
/**
 * Created by PhpStorm.
 * User: ruantofly
 * Date: 2020/3/9
 * Time: 19:46
 */

namespace Ruantofly\IO\NonBlocking;

class Worker
{

    private static $_map = array();

    public $onConnect = null;
    public $onReceive = null;
    public $onClose = null;

    public $socket = null;

    public function __construct($socket_address)
    {
        //$this->on('start','start');
        $this->socket = @stream_socket_server($socket_address);
        echo $socket_address."\n";
    }

    public function accept()
    {
        while(true){
            $client = @stream_socket_accept($this->socket);

            if (is_callable($this->onConnect)) {
                // 执行函数
                ($this->onConnect)($this, $client);
            }

            $data = fread($client, 65535);
            if (is_callable($this->onReceive)) {
                ($this->onReceive)($this, $client, $data);
            }
            // 处理完成之后关闭连接
            fclose($client);

        }
    }

    // 发送信息
    public function send($conn, $data)
    {
        $response = "HTTP/1.1 200 OK\r\n";
        $response .= "Content-Type: text/html;charset=UTF-8\r\n";
        $response .= "Connection: keep-alive\r\n";
        $response .= "Content-length: ".strlen($data)."\r\n\r\n";
        $response .= $data;
        fwrite($conn, $response);
    }

    // 启动服务的
    public function start()
    {
        $this->accept();
    }


    //on事件绑定
    //类似jquery绑定事件
    public function on($name, $callback)
    {
        if(!is_callable($callback))
            return false;
        if(!isset(self::$_map[$name]))
        {
            self::$_map[$name] = array();
        }

        self::$_map[$name][] = $callback;
    }






}