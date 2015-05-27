<?php

namespace Crontab\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\LockHandler;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

use Crontab\Parser;

class RequestListener{

    protected $container;

    public function __construct(ContainerInterface $container){
        $this->container = $container;
    }
    
    public function onKernelRequest(GetResponseEvent $event){
        $crons = $this->container->getParameter('crontab');
        if (!count($crons)) return;

        $lockHandler = new LockHandler('crontab.lock');
        
        if (!$lockHandler->lock()) return;

        foreach( $crons as $cron ){
            
            $timestamp = Parser::parse($cron['format']); //TODO: Fetch last time executued
            
            if( $timestamp <= time() )
                $this->container->get($cron['service'])->run();
        }
        //$event->setResponse(new Response($response));
    }
}
