<?php

namespace Crontab\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

class RequestListener{

    protected $container;

    public function __construct(ContainerInterface $container){
        $this->container = $container;
    }
    
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        
        $crons = $this->container->getParameter('crontab');
        
        $service = $crons[0]['service'];
        
        $event->setResponse(new Response($this->container->get($service)->run()));
    }
}
