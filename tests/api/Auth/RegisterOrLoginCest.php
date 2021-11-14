<?php

class RegisterOrLoginCest
{
    public function registerOrLoginUserViaAPI(\ApiTester $I)
    {
      $I->haveHttpHeader('Content-Type', 'application/json');
      $I->haveHttpHeader('accept', 'application/json');
      $I->haveHttpHeader('Authorization', 'Basic ' .  base64_encode("testclient:testsecret"));

      $data = [
        'name' => 'John Doe',
        'username' => 'user@example.com',
        'password' => 'googletoken',
        'oauth_provider' => 'google',
        'oauth_uid' => 'googleuid',
        'grant_type' => 'password',
      ];

      $I->sendPost('/signIn', $data);

      $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
      $I->seeResponseIsJson();

      $expectedResponse = [
        [  
          'name' => 'John Doe',
          'email' => 'user@example.com',
          'created_at' => '2021-11-13 05:54:58',
          'id' => "12",
          'oauth_provider' => 'google',
          'oauth_uid' => 'googleuid',
          'password' => '$2y$10$GYW4n7r7RthBcnERNm8Cke7EiyxcITzjlVmtbh4zpJe2bx9HHCqsW',
          'updated_at' => '2021-11-13 05:54:58'
        ],
        '{"access_token":"a12359d66452ae348abba6d7e8b50460200a2baf","expires_in":3600,"token_type":"Bearer","scope":null,"refresh_token":"c6258e68a5dc337b860b24a6f2fb75780d4dd49f"}'
      ];

      $I->seeResponseContainsJson($expectedResponse);
    }
}
