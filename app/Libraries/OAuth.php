<?php namespace App\Libraries;

use App\Libraries\CustomOauthStorage;

class OAuth {
    var $server;

    function __construct()
    {
        $this->init();    
    }

    public function init() {
        $defaultGroup = getenv('defaultGroup');
        $dsn = getenv("database.$defaultGroup.dsn");
        $username = getenv("database.$defaultGroup.username");
        $password = getenv("database.$defaultGroup.password");

        $storage = new CustomOauthStorage(['dsn' => $dsn, 'username' => $username, 'password' => $password]);
        $this->server = new \OAuth2\Server($storage);
        $this->server->addGrantType(new \OAuth2\GrantType\UserCredentials($storage));
    }
}