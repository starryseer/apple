<?php


namespace Starryseer\Apple\Utility;

use Firebase\JWT\JWT;
use Firebase\JWT\JWK;

class AppleToken
{
    public static function getAppleSignInPayload($identityToken,$timeout = 5)
    {
        $identityPayload = self::decodeIdentityToken($identityToken,$timeout);
        return new \Starryseer\Apple\Utility\ASPayload($identityPayload);
    }

    /**
     * Decode the Apple encoded JWT using Apple's public key for the signing.
     *
     * @param string $identityToken
     * @param int $timeout
     * @return object
     */
    public static function decodeIdentityToken($identityToken,$timeout)
    {
        $publicKeyData = self::fetchPublicKey($timeout);

        $publicKey = $publicKeyData['publicKey'];
        $alg = $publicKeyData['alg'];

        $payload = JWT::decode($identityToken, $publicKey, [$alg]);

        return $payload;
    }

    public static function fetchPublicKey($timeout)
    {
        $http_client = new \EasySwoole\HttpClient\HttpClient('https://appleid.apple.com/auth/keys');
        $http_client->setTimeout($timeout);
        $response = $http_client->get();
        $publicKeys = $response->getBody();
        $decodedPublicKeys = json_decode($publicKeys, true);

        if(!isset($decodedPublicKeys['keys']) || count($decodedPublicKeys['keys']) < 1) {
            throw new Exception('Invalid key format.');
        }

        $parsedKeyData = $decodedPublicKeys['keys'][0];
        $parsedPublicKey= JWK::parseKey($parsedKeyData);
        $publicKeyDetails = openssl_pkey_get_details($parsedPublicKey);

        if(!isset($publicKeyDetails['key'])) {
            throw new Exception('Invalid public key details.');
        }

        return [
            'publicKey' => $publicKeyDetails['key'],
            'alg' => $parsedKeyData['alg']
        ];
    }
}