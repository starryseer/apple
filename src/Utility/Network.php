<?php


namespace Starryseer\AppPay\Utility;

use EasySwoole\HttpClient\HttpClient;

class Network
{
    public static $TIMEOUT = 15;

    public static function get($endpoint, $data, $options = [])
    {
        $client = new HttpClient($endpoint);
        if (!empty($options)) {
            foreach ($options as $key => $value) {
                if($key == 'timeout')
                    $client->setTimeout($value);
                else
                    $client->setClientSetting($key, $value);
            }
        }
        $client->setQuery($data);
        return $client->get();
    }

    public static function post($endpoint, $data, $options = [])
    {
        $client = new HttpClient($endpoint);
        if (!empty($options)) {
            foreach ($options as $key => $value) {
                if($key == 'timeout')
                    $client->setTimeout($value);
                else
                    $client->setClientSetting($key, $value);
            }
        }
        return $client->setTimeout(self::$TIMEOUT)->post($data);
    }

    public static function postJson(string $endpoint, string $data, $options = [])
    {
        $client = new HttpClient($endpoint);
        $client->setTimeout(self::$TIMEOUT);
        if (!empty($options)) {
            foreach ($options as $key => $value) {
                if($key == 'timeout')
                    $client->setTimeout($value);
                else
                    $client->setClientSetting($key, $value);
            }
        }
        return $client->postJson($data);
    }

    public static function postXML(string $endpoint, string $data, $options = [])
    {
        $client = new HttpClient($endpoint);
        $client->setTimeout(self::$TIMEOUT);
        if (!empty($options)) {
            foreach ($options as $key => $value) {
                if($key == 'timeout')
                    $client->setTimeout($value);
                else
                    $client->setClientSetting($key, $value);
            }
        }
        return $client->postXml($data);
    }
}