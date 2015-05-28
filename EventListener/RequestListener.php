<?php

namespace VM\Cron\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\LockHandler;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

use VM\Cron\Entity\Cron;

class RequestListener{

    protected $container;

    public function __construct(ContainerInterface $container){
        $this->container = $container;
    }
    
    public function onKernelRequest(GetResponseEvent $event){

        $lockHandler = new LockHandler('cron.lock');

        if (!$lockHandler->lock()) return;
        
        $crons = $this->container->getParameter('cron');

        foreach( $crons as $cron ){

            $service = $this->container->get($cron['service']);
            $job = new Cron( $cron['format'], $cron['service'], $this->container );
            $job->run();
        }
    }

}
