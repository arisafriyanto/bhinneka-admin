<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\TransactionDetailModel;
use App\Models\UnitModel;

class ProductController extends BaseController
{
    protected $productModel;
    protected $unitModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->unitModel    = new UnitModel();
    }

    public function index()
    {
        $data['products'] = $this->productModel->getProductsWithUnits();
        return view('products/index', $data);
    }

    public function create()
    {
        $lastProduct = $this->productModel->orderBy('id', 'DESC')->first();
        $lastCode    = $lastProduct ? substr($lastProduct['code'], 2) : 0;
        $newCode     = 'PR' . str_pad((int)$lastCode + 1, 2, '0', STR_PAD_LEFT);

        $data = [
            'units' => $this->unitModel->findAll(),
            'newCode' => $newCode,
        ];

        return view('products/create', $data);
    }

    public function store()
    {
        $rules = [
            'unit'  => 'required|min_length[1]|is_not_unique[units.id]',
            'code'  => 'required|min_length[3]|is_unique[products.code]',
            'name'  => 'required|min_length[3]',
            'price' => 'required|numeric|min_length[1]',
            'stock' => 'required|numeric|min_length[1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'unit_id' => $this->request->getPost('unit'),
            'code'    => $this->request->getPost('code'),
            'name'    => $this->request->getPost('name'),
            'price'   => $this->request->getPost('price'),
            'stock'   => $this->request->getPost('stock'),
        ];

        $this->productModel->save($data);
        return redirect()->to('/products')->with('success', 'Data produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'product' => $this->productModel->find($id),
            'units'   => $this->unitModel->findAll()
        ];

        return view('products/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'unit'    => 'required|is_not_unique[units.id]',
            'name'    => 'required|alpha_numeric_space|min_length[3]',
            'price'   => 'required|numeric|min_length[1]',
            'stock'   => 'required|numeric|min_length[1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'unit_id' => $this->request->getPost('unit'),
            'name'    => $this->request->getPost('name'),
            'price'   => $this->request->getPost('price'),
            'stock'   => $this->request->getPost('stock'),
        ];

        $this->productModel->update($id, $data);
        return redirect()->to('/products')->with('success', 'Data produk berhasil diperbarui.');
    }

    public function delete($id)
    {
        $transactionDetailModel = new TransactionDetailModel();
        $relatedTransactions = $transactionDetailModel->where('product_id', $id)->findAll();

        if (!empty($relatedTransactions)) {
            return redirect()->to('/products')->with('error', 'Data produk tidak dapat dihapus karena masih terkait dengan transaksi.');
        }

        $this->productModel->delete($id);
        return redirect()->to('/products')->with('success', 'Data produk berhasil dihapus.');
    }
}
