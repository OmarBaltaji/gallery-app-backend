<?php

class UpdateGalleryCest
{
    public function updateGalleryViaAPI(\ApiTester $I)
    {
      $I->haveHttpHeader('Content-Type', 'application/json');
      $I->haveHttpHeader('accept', 'application/json');
      $I->haveHttpHeader('Authorization', 'Bearer ' .  '3f7a32d712bd66fc160f5b61a02a69c28c3a79dd');

      $data = [
        'name' => 'Gallery 19',
        'keywords' => 'Keywords 19',
        'description' => 'Description 19',
      ];

      $I->sendPut('/gallery/' . 4, $data);

      $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
      $I->seeResponseIsJson();

      $expectedResponse = [
        'id' => '4',
        'name' => 'Gallery 19',
        'keywords' => 'Keywords 19',
        'description' => 'Description 19',
      ];

      $I->seeResponseContainsJson($expectedResponse);
    }
}
