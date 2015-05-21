<?php

namespace Crontab\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;

class RequestListener{
   public function onKernelRequest(GetResponseEvent $event)
   {
       $request = $event->getRequest();
       //Cron.
   }
}
