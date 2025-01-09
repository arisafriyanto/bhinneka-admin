<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnitModel;

class UnitController extends BaseController
{
    protected $unitModel;

    public function __construct()
    {
        $this->unitModel = new UnitModel();
    }

    public function index()
    {
        $data['units'] = $this->unitModel->findAll();
        return view('units/index', $data);
    }

    public function create()
    {
        return view('units/create');
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[1]|is_unique[units.name,id,{id}]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $this->unitModel->save([
            'name' => $this->request->getPost('name'),
        ]);

        return redirect()->to('/units')->with('success', 'Data satuan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['unit'] = $this->unitModel->find($id);
        return view('units/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'name' => 'required|min_length[1]|is_unique[units.name,id,' . $id . ']',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $this->unitModel->update($id, [
            'name' => $this->request->getPost('name'),
        ]);
        return redirect()->to('/units')->with('success', 'Data satuan berhasil diedit.');
    }

    public function delete($id)
    {
        $this->unitModel->delete($id);
        return redirect()->to('/units')->with('success', 'Data satuan berhasil dihapus.');
    }
}
