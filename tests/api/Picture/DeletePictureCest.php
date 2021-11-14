<?php

class DeletePictureCest
{
    public function deletePictureCestViaApi(\ApiTester $I)
    {
      $I->haveHttpHeader('Content-Type', 'application/json');
      $I->haveHttpHeader('accept', 'application/json');
      $I->haveHttpHeader('Authorization', 'Bearer ' .  '3f7a32d712bd66fc160f5b61a02a69c28c3a79dd');

      $I->sendPost('/picture/delete/' . 2);

      $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
      $I->seeResponseIsJson();

      $expectedResponse = [
        'id' => 2,
        'filename' => '/assets/uploads/0mr-Bel/Gallery-1-/NICKELODEON_AVATAR_113_204396_1920x1080_1.jpg',
        'gallery_id' => 1,
        'created_at' => '2021-11-13 23:37:26.350',
        'updated_at' => '2021-11-13 23:37:26.350',
      ];

      $I->seeResponseContainsJson($expectedResponse);
    }
}
