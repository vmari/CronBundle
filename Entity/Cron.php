<?php

namespace Crontab\Entity;

use Cron\CronExpression;

class Cron{

    private $format;

    private $service;

    private $container;

    function __construct( $format, $service , $container ){

        $this->format = $format;

        $this->service = $service;

        $this->container = $container;
    }

    private function getRoot(){
        $env = $this->container->get('kernel')->getEnvironment();

        $dirname = '../app/cache/'.$env.'/crontab';

        if (!is_dir($dirname))
        {
            mkdir($dirname, 0755, true);
        }
        return $dirname;
    }

    private function getFileCacheName(){
        return $this->getRoot().'/'.md5( $this->format.$this->service ).'.cron';
    }

    public function getLastRun(){
        $filename = $this->getFileCacheName();
        if(!file_exists($filename)) return 0;
        return intval(@file_get_contents($filename));
    }

    public function setLastRun($time){
        file_put_contents($this->getFileCacheName(), $time);
    }

    public function run(){
        $now = time();

        dump(array(
            'now'=> $now,
            'nextRun'=>$this->nextRun(),
            'lastRun'=>$this->getLastRun(),
            'format'=>$this->format
        ));
        if( $this->nextRun() <= $now ){

            $this->container->get($this->service)->run();
            $this->setLastRun( $now );
        }
    }

    public function nextRun(){
        $cron = CronExpression::factory($this->format);
        return $cron->getNextRunDate($this->getLastRun())->getTimestamp();
    }

}
