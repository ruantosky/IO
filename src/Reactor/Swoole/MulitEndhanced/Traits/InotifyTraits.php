<?php
/**
 * Created by PhpStorm.
 * User: ruantofly
 * Date: 2020/3/15
 * Time: 9:03
 */

namespace Ruantofly\IO\Reactor\Swoole\MulitEndhanced\Traits;

trait InotifyTraits
{
    /**
     * 设置文件监听的动作
     * @return [type] [description]
     */
    protected function watchEvent()
{
    return function($event){
        $action = 'file:';
        switch ($event['mask']) {
            case IN_CREATE:
                $action = 'IN_CREATE';
                break;

            case IN_DELETE:
                $action = 'IN_DELETE';
                break;
            case \IN_MODIFY:
                $action = 'IN_MODIF';
                break;
            case \IN_MOVE:
                $action = 'IN_MOVE';
                break;
        }
        debug('worker reloaded by inotify :'.$action." : ".$event['name']);

        // 这是整个方法中最核心的方法 ， 其余的全部是做装饰的  Kill -10  主进程
        posix_kill((pidGet($this->config['master_pid_files']))[0], SIGUSR1);
    };
}

}