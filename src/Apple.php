<?php


namespace Starryseer\Apple;

use Starryseer\Apple\Config;
use Starryseer\Apple\Pay\Order;
use Starryseer\Apple\Utility\Network;
use EasySwoole\Spl\SplArray;
use Starryseer\Apple\Login\User;
use Starryseer\Apple\Utility\AppleToken;
use Starryseer\Apple\Utility\ASPayload;

class Apple
{
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function userVerify(User $user,$timeout=5)
    {
        $appleSignInPayload = AppleToken::getAppleSignInPayload($user->getIdentityToken());
        return $appleSignInPayload->verifyUser($user->getClientUser());
    }

    public function orderReceipt(Order $order,$timeout=5)
    {
        try{
            $body = ['receipt-data'=>$order->getReceipt()];
            $response = Network::postJson($this->config->getGateway(),json_encode($body,true),['timeout'=>$timeout]);
            $response = $response->getBody();
            if (!$response)
                return false;

            $response = json_decode($response, true);
            if (isset($response['status']) and $response['status'] == 0)
            {
                return new SplArray( $response['receipt'] );
            }
        }
        catch (\Exception $e)
        {
            return false;
        }
    }
}