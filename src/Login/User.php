<?php


namespace Starryseer\Apple\Login;


class User
{
    protected $identityToken;
    protected $clientUser;

    public function setIdentityToken($identityToken)
    {
        $this->identityToken = $identityToken;
    }

    public function getIdentityToken()
    {
        return $this->identityToken;
    }

    public function setClientUser($clientUser)
    {
        $this->clientUser = $clientUser;
    }

    public function getClientUser()
    {
        return $this->clientUser;
    }

}