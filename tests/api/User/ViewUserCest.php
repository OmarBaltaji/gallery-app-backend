<?php

class ViewUserCest
{
    public function getUserViaApi(\ApiTester $I)
    {
      $I->haveHttpHeader('Content-Type', 'application/json');
      $I->haveHttpHeader('accept', 'application/json');
      $I->haveHttpHeader('Authorization', 'Bearer ' .  '86483cd583d0c2b663328e35a60744e3cae7d2a9');;

      $I->sendGet('/user');

      $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
      $I->seeResponseIsJson();

      $expectedResponse = [
        'name' => '0mr Bel',
        'email' => 'omar.baltaji09@gmail.com',
        'created_at' => '2021-11-10 12:46:30',
        'id' => "10",
        'oauth_provider' => 'google',
        'oauth_uid' => '114501879662776714765',
        'password' => '$2y$10$1LmR1bsBsdyUqa3Mz7TLO.fVO1hQh4DpJ8YepIyjcjqKNtb1oYlUy',
        'updated_at' => '2021-11-10 12:46:30'
      ];

      $I->seeResponseContainsJson($expectedResponse);
    }
}
