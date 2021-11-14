<?php

class CreateGalleryCest
{
    public function createGalleryViaAPI(\ApiTester $I)
    {
      $I->haveHttpHeader('Content-Type', 'application/json');
      $I->haveHttpHeader('accept', 'application/json');
      $I->haveHttpHeader('Authorization', 'Bearer ' .  '3f7a32d712bd66fc160f5b61a02a69c28c3a79dd');

      $data = [
        'name' => 'Gallery 19',
        'keywords' => 'Keywords',
        'description' => 'Description',
      ];

      $I->sendPost('/gallery', $data);

      $I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED); // 201
      $I->seeResponseIsJson();

      $expectedResponse = [
        'id' => 3,
        'name' => 'Gallery 19',
        'keywords' => 'Keywords',
        'description' => 'Description',
        'user_id' => '2',
        'code' => '618fb2e1c8dff',
      ];

      $I->seeResponseContainsJson($expectedResponse);
    }
}
