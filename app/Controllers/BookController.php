<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use CodeIgniter\API\ResponseTrait;

class BookController extends BaseController
{
    use ResponseTrait;
    protected $format = 'json';

    public function index()
    {
        $model = new BookModel();
        return $this->respond($model->findAll());
    }

    public function show($id = null)
    {
        $model = new BookModel();
        $data = $model->find($id);
        if ($data) {
            return $this->respond($data);
        }
        return $this->failNotFound("Book not found");
    }

    public function create()
    {
        $model = new BookModel();
        $data = $this->request->getPost();

        $file = $this->request->getFile('cover');
        if ($file && $file->isValid()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/covers', $fileName);
            $data['cover'] = $fileName;
        }

        if ($model->insert($data)) {
            return $this->respondCreated(['status' => true, 'message' => 'Book created']);
        }

        return $this->failValidationErrors($model->errors());
    }

    public function update($id = null)
    {
        $model = new BookModel();
        $book = $model->find($id);
        if (!$book) {
            return $this->failNotFound("Book not found");
        }

        $data = $this->request->getVar();

        $file = $this->request->getFile('cover');
        if ($file && $file->isValid()) {
            if ($book['cover'] && file_exists('uploads/covers/' . $book['cover'])) {
                unlink('uploads/covers/' . $book['cover']);
            }

            $fileName = $file->getRandomName();
            $file->move('uploads/covers', $fileName);
            $data['cover'] = $fileName;
        }

        if ($model->update($id, $data)) {
            return $this->respond(['status' => true, 'message' => 'Book updated']);
        }

        return $this->failValidationErrors($model->errors());
    }


    public function delete($id = null)
    {
        $model = new BookModel();
        $book = $model->find($id);
        if (!$book) {
            return $this->failNotFound("Book not found");
        }

        if ($book['cover'] && file_exists('uploads/covers/' . $book['cover'])) {
            unlink('uploads/covers/' . $book['cover']);
        }

        $model->delete($id);
        return $this->respondDeleted(['status' => true, 'message' => 'Book deleted']);
    }
}
