<?php namespace App\Libraries;

use App\Libraries\CustomOauthStorage;

class OAuth {
    var $server;

    function __construct()
    {
        $this->init();    
    }

    public function init() {
        $dsn = getenv('database.default.dsn');
        $username = getenv('database.default.username');
        $password = getenv('database.default.password');
        
        $storage = new CustomOauthStorage(['dsn' => $dsn, 'username' => $username, 'password' => $password]);
        $this->server = new \OAuth2\Server($storage);
        $this->server->addGrantType(new \OAuth2\GrantType\UserCredentials($storage));
        
        // $clients = array('testclient' => array('client_secret' => 'testsecret'));
        // $storage = new \OAuth2\Storage\Memory(array('client_credentials' => $clients));
        // create the grant type
        // $grantType = new \OAuth2\GrantType\ClientCredentials($storage);
        // $this->server->addGrantType($grantType);
    }
}