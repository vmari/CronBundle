<?php

namespace Crontab\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
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
        if(!count($crons)) return;
        //TODO: cron.lock
        
        
        $response = '';
        
        foreach( $crons as $cron ){
            //TODO: analize cron to determine if must be executed
            
            $timestamp = Parser::parse($cron['format']);
            
            if($mustExecute)
                $this->container->get($cron['service'])->run();
        }
        $event->setResponse(new Response($response));
    }
}
