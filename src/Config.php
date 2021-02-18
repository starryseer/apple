<?php


namespace Starryseer\Apple;

use EasySwoole\Spl\SplEnum;

class Config extends SplEnum
{
    protected $gateway;


    public function setGateway($gateway)
    {
        $this->gateway = $gateway;
    }

    public function getGateway()
    {
        return $this->gateway;
    }


}