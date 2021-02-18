<?php


namespace Starryseer\Apple;

use EasySwoole\Spl\SplEnum;

class GateWay extends SplEnum
{
    const NORMAL = 'https://buy.itunes.apple.com/verifyReceipt';
    const SANDBOX = 'https://sandbox.itunes.apple.com/verifyReceipt';

}