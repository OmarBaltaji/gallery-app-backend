<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\AuthUser;
use App\Models\GalleryModel;
use App\Models\PictureModel;
use CodeIgniter\API\ResponseTrait;

class Picture extends BaseController
{
    use ResponseTrait;

    public function getGalleryPictures() {
        $rules = [
            'gallery_id' => 'required',
        ];

        if (! $this->validate($rules)) {
            return $this->fail(implode('<br>', $this->validator->getErrors()));
        } else {
            $gallery_id = $this->request->getVar('gallery_id');
            $db = db_connect();
            $builder = $db->table('galleries');
            $builder->select('pictures.*');
            $gallery_pictures = $builder->join('pictures', 'galleries.id = pictures.gallery_id')->where('galleries.id', $gallery_id)->get()->getResult();
            return $this->respond($gallery_pictures);
        }
    }

    public function create()
    {
        $rules = [
            'file' => 'uploaded[file]|is_image[file]',
            'gallery_id' => 'string|required',
        ];

        if (! $this->validate($rules)) {
            return $this->fail(implode('<br>', $this->validator->getErrors()));
        } else {

            $file = $this->request->getFile('file');
            
            if(!$file->isValid()) {
                return $this->fail($file->getErrorString());
            }

            $galleryModel = new GalleryModel();
            $gallery = $galleryModel->find($this->request->getVar('gallery_id'));
            $user = AuthUser::get();
            $userName = $user['name'];
            $userName = str_replace(' ', '-', $userName);
            $galleryName = $gallery['name'];
            $galleryName = str_replace(' ', '-', $galleryName);

            $path = "/assets/uploads/$userName/$galleryName/";
            $file->move('.' . $path);

            $data = [
                'filename' => $path . $file->getName(),
                'gallery_id' => $this->request->getVar('gallery_id'),
            ];

            $PictureModel = new PictureModel();

            $picture = $PictureModel->insert($data);

            return $this->respondCreated($picture);
        }
    }

    public function delete($id = null) {
        $PictureModel = new PictureModel();
        $data = $PictureModel->find($id);

        if($data) {
            $PictureModel->delete($id);
            return $this->respondDeleted($data);
        } else {
            return $this->failNotFound('Picture not found');
        }
    }
}
