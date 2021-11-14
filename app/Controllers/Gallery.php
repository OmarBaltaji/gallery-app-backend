<?php

namespace App\Controllers;

// use App\Controllers\BaseController;
// use App\Models\GalleryModel;
// use CodeIgniter\API\ResponseTrait;

use App\Helpers\AuthUser;

use CodeIgniter\RESTful\ResourceController;

class Gallery extends ResourceController
{
    protected $modelName = 'App\Models\GalleryModel';
    protected $format = 'json';

    public function index() {
        $user = AuthUser::get();
        $db = db_connect();
        $builder = $db->table('users');
        $builder->select('galleries.*');
        $userGalleries = $builder->join('galleries', 'users.id = galleries.user_id')->where('users.id', $user['id'])->get()->getResult();
        return $this->respond($userGalleries);
    }

    public function create()
    {
        $user = AuthUser::get();
        $rules = [
            'name' => 'required|string|max_length[20]',
			'keywords' => 'required|string',
			'description' => 'string',
        ];

        if (! $this->validate($rules)) {
            return $this->fail(implode('<br>', $this->validator->getErrors()));
        } else {
            $data = [
                'name' => $this->request->getVar('name'),
                'keywords' => $this->request->getVar('keywords'),
                'description' => $this->request->getVar('description'),
                'user_id' => $user['id'],
                'code' => uniqid()
            ];


            $newGallery = $this->model->insert($data);
            $data['id'] = $newGallery;
            return $this->respondCreated($data);
        }
    }

    public function show($id = null) {
        $data = $this->model->find($id);
        return $this->respond($data);
    }

    public function update($id = null) {
        $rules = [
            'name' => 'required|string|max_length[20]',
			'keywords' => 'required|string',
			'description' => 'string',
        ];

        if (! $this->validate($rules)) {
            return $this->fail(implode('<br>', $this->validator->getErrors()));
        } else {
            $data = [
                'id' => $id,
                'name' => $this->request->getVar('name'),
                'keywords' => $this->request->getVar('keywords'),
                'description' => $this->request->getVar('description'),
            ];

            $this->model->save($data);
            return $this->respond($data);
        }
    }

    public function delete($id = null) {
        $data = $this->model->find($id);

        if($data) {
            $this->model->delete($id);
            return $this->respondDeleted($data);
        } else {
            return $this->failNotFound('Gallery not found');
        }
    }
}
