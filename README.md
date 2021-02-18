<h1 align="center"> apppay </h1>

<p align="center"> 基于easyswoole的苹果集成组件，包含了苹果登录和苹果支付.</p>


## Installing

```shell
$ composer require starryseer/apple
```

## Usage
```shell
    订单凭证验证
    
    function orderReceipt()
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
```

    
```shell
    用户登录验证
    
    function userVerify()
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
```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/starryseer/apple/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/starryseer/apple/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT