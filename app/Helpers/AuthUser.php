<?php namespace App\Helpers;

use App\Libraries\OAuth;
use App\Models\UserModel;

class AuthUser {
    public static function get() {
        $oauth = new OAuth();
        $token = $oauth->server->getAccessTokenData(\OAuth2\Request::createFromGlobals());
        $userModel = new UserModel();
        $user = $userModel->find($token['user_id']);
        return $user;
    }
}