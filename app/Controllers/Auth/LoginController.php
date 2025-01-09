<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $rules = [
            'username' => 'required|alpha_numeric|min_length[3]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['role'] !== 'admin') {
                session()->setFlashdata('error', 'Halaman user sekarang belum tersedia.');
                return redirect()->to('/login');
            }

            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
            ]);
            return redirect()->to('/');
        }

        session()->setFlashdata('error', 'Username atau Password salah.');
        return redirect()->to('/login');
    }
}
