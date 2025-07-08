<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class AuthController extends BaseController
{
    use ResponseTrait;
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    public function login()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $this->userModel->where('email', $email)->first();

        if (is_null($user)) {
            return $this->respond([
                'status' => 401,
                'message' => 'Email is not found.'
            ], 401);
        }

        if (!password_verify($password, $user['password'])) {
            return $this->respond([
                'status' => 401,
                'message' => 'Invalid password.'
            ], 401);
        }

        $data = [
            'id' => $user['user_id'],
            'name' => $user['name'],
            'email' => $user['email'],
        ];

        return $this->respond([
            'status' => true,
            'message' => 'Login successfully!',
            'data' => $data
        ], 200);
    }

    public function register()
    {
        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Validasi sederhana
        if (!$name || !$email || !$password) {
            return $this->respond([
                'status' => false,
                'message' => 'Semua field wajib diisi.'
            ], 400);
        }

        // Cek apakah email sudah terdaftar
        $existingUser = $this->userModel->where('email', $email)->first();
        if ($existingUser) {
            return $this->respond([
                'status' => false,
                'message' => 'Email sudah digunakan.'
            ], 409);
        }

        // Simpan user baru
        $this->userModel->save([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
        ]);

        return $this->respond([
            'status' => true,
            'message' => 'Registrasi berhasil.'
        ], 201);
    }
}
