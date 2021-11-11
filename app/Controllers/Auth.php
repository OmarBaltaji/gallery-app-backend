<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\OAuth;
use \OAuth2\Request;

class Auth extends BaseController
{
    use ResponseTrait;

    public function registerOrLogin() {
        $name = $this->request->getVar('name');
        log_message('info', $name);

        $user_model = new UserModel();
        $user = $user_model->where('oauth_uid', $this->request->getVar('oauth_uid'))->first(); // Find user by google id to see if they already exist
        log_message('info', json_encode($user));
       
        if($user) { // User already exists
            $oauthResponse = $this->login();
            return $this->respond([$user, $oauthResponse['body']], $oauthResponse['code']);
        }

        // Else create new user
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'oauth_uid' => $this->request->getVar('oauth_uid'),
            'oauth_provider' => 'google',
        ];

        $user_id = $user_model->insert($data);

        if($user_id) {
            $newUser = $user_model->find($user_id);
            $oauthResponse = $this->login();
            return $this->respondCreated([$newUser, $oauthResponse['body']], $oauthResponse['code']);
        } else {
            return $this->failServerError();
        }
    }

    private function login() {
        $oauth = new OAuth();
        $requestOauth = new \OAuth2\Request();
        $respond = $oauth->server->handleTokenRequest($requestOauth->createFromGlobals());
        $code = $respond->getStatusCode();
        $body = $respond->getResponseBody();

        return [
            'body' => $body,
            'code' => $code,
        ];
    }
}