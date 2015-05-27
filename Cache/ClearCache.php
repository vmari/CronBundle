<?php

namespace CronBundle\Cache;

use Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface;

class ClearCache implements CacheClearerInterface
{
    public function clear($cacheDir){
        //TODO: clear all files in cache directory
    }

}