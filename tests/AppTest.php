<?php


class AppTest
{
    public function orderReceipt()
    {
        //客户端传入的凭证
        $receipt = '';
        //实例化配置文件
        $config = new \Starryseer\Apple\Config();
        //设置环境 正式服 NORMAL 测试服 SANDBOX
        $config->setGateway(\Starryseer\Apple\GateWay::SANDBOX);

        //实例化订单信息
        $order = new \Starryseer\Apple\Pay\Order();
        //在订单内设置凭证，如果没有base64_dencode,则参数传入encry=>true
        $order->setReceipt($receipt,true);

        //实例化苹果对象
        $apple= new \Starryseer\Apple\Apple($config);
        //调用orderReceipt方法获取订单信息
        $response = $apple->orderReceipt($order,10);

    }

    public function userVerify()
    {
        //客户端传入的token
        $identityToken = '';
        //用户id
        $clientUser = '';
        //实例化配置文件
        $config = new \Starryseer\Apple\Config();
        //设置环境 正式服 NORMAL 测试服 SANDBOX
        $config->setGateway(\Starryseer\Apple\GateWay::SANDBOX);

        //实例化订单信息
        $user = new \Starryseer\Apple\Login\User();
        //在订单内设置凭证，如果没有base64_dencode,则参数传入encry=>true
        $user->setClientUser($clientUser);
        $user->setIdentityToken($identityToken);

        //实例化苹果对象
        $apple= new \Starryseer\Apple\Apple($config);
        //调用userVerify方法，验证成功返回true，失败返回false
        $res = $apple->userVerify($user,10);

    }
}