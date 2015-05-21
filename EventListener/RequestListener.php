<?php

namespace Crontab\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

class RequestListener{
    protected $em;

    public function __construct(EntityManager $em){
        $this->em = $em;
    }
    
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $crons = $this->em->getRepository('CrontabBundle:Cron')->findAll();
        //$event->setResponse(new Response('<pre>'.print_r($crons,1)));
    }
}
