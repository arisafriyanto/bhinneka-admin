<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('users/index', $data);
    }

    public function create()
    {
        return view('users/create');
    }

    public function store()
    {
        $rules = [
            'name' => 'required|alpha_numeric_space|min_length[3]',
            'username' => 'required|alpha_numeric|min_length[3]|max_length[100]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'role'    => 'required|in_list[admin,purchasing]',
            'company_name' => 'permit_empty|min_length[3]',
            'company_address' => 'permit_empty|min_length[3]',
            'company_city' => 'permit_empty|min_length[3]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'name'             => $this->request->getPost('name'),
            'username'         => $this->request->getPost('username'),
            'password'         => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'             => $this->request->getPost('role'),
            'company_name'     => $this->request->getPost('company_name'),
            'company_address'  => $this->request->getPost('company_address'),
            'company_city'     => $this->request->getPost('company_city'),
        ];

        $this->userModel->save($data);
        return redirect()->to('/users')->with('success', 'Data user berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id);
        return view('users/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'name' => 'required|alpha_numeric_space|min_length[3]',
            'username' => 'required|alpha_numeric|min_length[3]|is_unique[users.username,id,' . $id . ']',
            'password' => 'permit_empty|min_length[6]',
            'role'    => 'required|in_list[admin,purchasing]',
            'company_name' => 'permit_empty|min_length[3]',
            'company_address' => 'permit_empty|min_length[3]',
            'company_city' => 'permit_empty|min_length[3]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'name'             => $this->request->getPost('name'),
            'username'         => $this->request->getPost('username'),
            'role'             => $this->request->getPost('role'),
            'company_name'     => $this->request->getPost('company_name'),
            'company_address'  => $this->request->getPost('company_address'),
            'company_city'     => $this->request->getPost('company_city'),
        ];

        $userId = session()->get('user_id');
        $user = $this->userModel->find($id);

        if ($userId == $user['id']) {
            unset($data['role']);
        }

        if (!empty($this->request->getPost('password'))) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);
        return redirect()->to('/users')->with('success', 'Data user berhasil diperbarui.');
    }

    public function delete($id)
    {
        $currentUserId = session()->get('user_id');
        if ($id == $currentUserId) {
            return redirect()->to('/users')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $transactionModel = new TransactionModel();
        $relatedTransactions = $transactionModel->where('user_id', $id)->findAll();

        if (!empty($relatedTransactions)) {
            return redirect()->to('/users')->with('error', 'Data user tidak dapat dihapus karena masih terkait dengan transaksi.');
        }
        $this->userModel->delete($id);
        return redirect()->to('/users')->with('success', 'Data user berhasil dihapus.');
    }
}
