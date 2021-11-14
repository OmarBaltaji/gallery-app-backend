<?php

use CodeIgniter\HTTP\Files\UploadedFile;

class UploadPictureCest
{
    public function uploadPictureViaApi(\ApiTester $I)
    {
      $I->haveHttpHeader('Content-Type', 'application/json');
      $I->haveHttpHeader('accept', 'application/json');
      $I->haveHttpHeader('Authorization', 'Bearer ' .  '3f7a32d712bd66fc160f5b61a02a69c28c3a79dd');

      $filename = 'Avatar.jpg';
      $path = codecept_data_dir();
      $mime = 'image/jpeg';

      $uploadedFile = new UploadedFile($path . $filename, $filename, $mime, filesize($path . $filename));

      $data = [
      'file' => [$uploadedFile],
        'gallery_id' => '1',
      ];

      $I->sendPost('/upload', $data);

      $I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED); // 201
      $I->seeResponseIsJson();

      $expectedResponse = [
        'id' => 2,
        'filename' => '',
        'gallery_id' => 1,
        'created_at' => '',
        'deleted_at' => '',
      ];

      $I->seeResponseContainsJson($expectedResponse);
    }
}
