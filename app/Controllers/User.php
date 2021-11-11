<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\OAuth;
use App\Helpers\AuthUser;

class User extends BaseController
{
    use ResponseTrait;

    public function view()
    {
        $user = AuthUser::get();
        return $this->respond($user);
    }
}
