<?php

class DeleteGalleryCest
{
    public function deleteGalleryViaAPI(\ApiTester $I)
    {
      $I->haveHttpHeader('Content-Type', 'application/json');
      $I->haveHttpHeader('accept', 'application/json');
      $I->haveHttpHeader('Authorization', 'Bearer ' .  '3f7a32d712bd66fc160f5b61a02a69c28c3a79dd');

      $I->sendDelete('/gallery/' . 3);

      $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
      $I->seeResponseIsJson();

      $expectedResponse = [
        'id' => 3,
        'name' => 'Gallery 19',
        'keywords' => 'Keywords',
        'description' => 'Description',
        'user_id' => 2,
        'code' => '618fb2e1c8dff',
      ];

      $I->seeResponseContainsJson($expectedResponse);
    }
}
