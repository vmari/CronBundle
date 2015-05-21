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
        $event->setResponse(new Response('<pre>'.print_r($this->container->getParameter('crontab'),1)));
    }
}
