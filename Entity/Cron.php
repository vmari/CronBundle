<?php

namespace CronBundle\Entity;

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
        $date = new \DateTime();

        if(!file_exists($filename)){
            $date->setTimestamp(0);
            return $date;
        }
        $date->setTimestamp(intval(@file_get_contents($filename)));
        return $date;
    }

    public function setLastRun( \DateTime $time ){
        file_put_contents($this->getFileCacheName(), $time->getTimestamp());
    }

    public function run(){
        $now = new \DateTime('now');
        if( $this->nextRun() <= $now ){

            $this->container->get($this->service)->run();
            $this->setLastRun($now);
        }
    }

    public function nextRun(){
        $cron = CronExpression::factory($this->format);
        return $cron->getNextRunDate($this->getLastRun());
    }

}
