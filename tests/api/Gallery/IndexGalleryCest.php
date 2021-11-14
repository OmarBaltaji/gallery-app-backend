<?php

class IndexGalleryCest
{
    public function getListOfGalleriesViaAPI(\ApiTester $I)
    {
      $I->haveHttpHeader('Content-Type', 'application/json');
      $I->haveHttpHeader('accept', 'application/json');
      $I->haveHttpHeader('Authorization', 'Bearer ' .  '3f7a32d712bd66fc160f5b61a02a69c28c3a79dd');

      $I->sendGet('/gallery');

      $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
      $I->seeResponseIsJson();

      $expectedResponse = [
        [   
          'id' => 1,
          'name' => 'Gallery 1',
          'keywords' => 'keysss',
          'description' => 'Desc 1',
          'user_id' => 2,
          'code' => '61902d7abff47',
        ],
        [   
          'id' => 4,
          'name' => 'Gallery 19',
          'keywords' => 'Keywords 19',
          'description' => 'Description 19',
          'user_id' => 2,
          'code' => '6190360ed6774',
        ]
      ];

      $I->seeResponseContainsJson($expectedResponse);
    }
}
