<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\TransactionDetailModel;
use App\Models\TransactionModel;
use App\Models\UserModel;
use CodeIgniter\Database\Config;

class TransactionController extends BaseController
{
    protected $transactionModel;
    protected $transactionDetailModel;
    protected $productModel;
    protected $userModel;
    protected $db;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->transactionDetailModel = new TransactionDetailModel();
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
        $this->db = Config::connect();
    }

    public function index()
    {
        $data['transactions'] = $this->transactionModel->getTransactionsWithUser();
        return view('transactions/index', $data);
    }

    public function create()
    {
        $data['products'] = $this->productModel->findAll();
        $users = $this->userModel->findAll();

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if ($user && $user['role'] == 'admin') {
            $data['users'] = array_filter($users, function ($user) use ($userId) {
                return $user['id'] != $userId;
            });
        } else {
            $data['users'] = $users;
        }

        return view('transactions/create', $data);
    }

    public function store()
    {
        $postData = $this->request->getPost();

        $rules = [
            'user_id' => 'required|min_length[1]|is_not_unique[users.id]',
            'products' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        if (!isset($postData['products']) || !is_array($postData['products'])) {
            return redirect()->back()->with('error', 'Produk wajib diisi.');
        }

        $this->db->transBegin();

        try {
            $totalQuantity = array_sum(array_column($postData['products'], 'quantity'));
            $totalPrice = array_sum(array_column($postData['products'], 'total_price'));

            $transactionData = [
                'user_id' => $postData['user_id'],
                'total_quantity' => $totalQuantity,
                'total_price' => $totalPrice,
            ];

            $transactionId = $this->transactionModel->insert($transactionData);

            if (!$transactionId) {
                throw new \Exception('Gagal menambahkan data transaksi.');
            }

            $monthRoman = $this->getRomanMonth(date('n'));
            $invoiceNumber = sprintf('%03d/TD/%s/%d', $transactionId, $monthRoman, date('Y'));

            $this->transactionModel->update($transactionId, ['invoice_number' => $invoiceNumber]);

            foreach ($postData['products'] as $product) {
                $productData = $this->productModel->find($product['product_id']);

                if ($product['quantity'] > $productData['stock']) {
                    throw new \Exception('Jumlah produk ' . $productData['name'] . ' melebihi stok yang tersedia.');
                }

                $product['subtotal_price'] = $product['price'] * $product['quantity'];
                $product['transaction_id'] = $transactionId;

                $this->transactionDetailModel->insert($product);

                $newStock = $productData['stock'] - $product['quantity'];
                $this->productModel->update($product['product_id'], ['stock' => $newStock]);
            }

            $this->db->transCommit();

            return redirect()->to('/transactions')->with('success', 'Data transaksi berhasil ditambahkan');
        } catch (\Exception $e) {
            $this->db->transRollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $data['transaction'] = $this->transactionModel
            ->where('id', $id)
            ->first();

        $data['transaction_details'] = $this->transactionDetailModel
            ->select('transaction_details.*, products.code, products.name, products.unit_id, units.name AS unit_name')
            ->join('products', 'products.id = transaction_details.product_id')
            ->join('units', 'units.id = products.unit_id')
            ->where('transaction_details.transaction_id', $id)
            ->findAll();

        $data['user'] = $this->userModel
            ->where('id', $data['transaction']['user_id'])
            ->first();

        $total_quantity = array_sum(array_column($data['transaction_details'], 'quantity'));
        $price = array_sum(array_column($data['transaction_details'], 'price'));

        $data['total_quantity'] = $total_quantity;
        $data['price'] = $price;

        return view('transactions/show', $data);
    }


    public function edit($id)
    {
        $transaction = $this->transactionModel->find($id);
        $transactionDetails = $this->transactionDetailModel->where('transaction_id', $id)->findAll();
        $products = $this->productModel->findAll();

        if (!$transaction) {
            return redirect()->to('/transactions')->with('error', 'Transaksi tidak ditemukan.');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        $users = $this->userModel->findAll();

        if ($user && $user['role'] == 'admin') {
            $data['users'] = array_filter($users, function ($user) use ($userId) {
                return $user['id'] != $userId;
            });
        } else {
            $data['users'] = $users;
        }

        return view('transactions/edit', [
            'transaction' => $transaction,
            'transactionDetails' => $transactionDetails,
            'products' => $products,
            'users' => $data['users'],
        ]);
    }

    public function update($id)
    {
        $postData = $this->request->getPost();

        $rules = [
            'user_id' => 'required|min_length[1]|is_not_unique[users.id]',
            'products' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        if (!isset($postData['products']) || !is_array($postData['products'])) {
            return redirect()->back()->with('error', 'Produk wajib diisi.');
        }

        $this->db->transBegin();

        try {
            $totalQuantity = array_sum(array_column($postData['products'], 'quantity'));
            $totalPrice = array_sum(array_column($postData['products'], 'total_price'));

            $transactionData = [
                'user_id' => $postData['user_id'],
                'total_quantity' => $totalQuantity,
                'total_price' => $totalPrice,
            ];

            $transactionUpdated = $this->transactionModel->update($id, $transactionData);

            $previousTransactionDetails = $this->transactionDetailModel->where('transaction_id', $id)->findAll();

            if (!$transactionUpdated) {
                throw new \Exception('Gagal memperbarui data transaksi.');
            }

            $this->transactionDetailModel->where('transaction_id', $id)->delete();

            // dd($postData['products'], $previousTransactionDetails);

            foreach ($postData['products'] as $product) {
                $productData = $this->productModel->find($product['product_id']);

                if ($product['quantity'] > $productData['stock']) {
                    throw new \Exception('Jumlah produk ' . $productData['name'] . ' melebihi stok yang tersedia.');
                }

                $product['subtotal_price'] = $product['price'] * $product['quantity'];
                $product['transaction_id'] = $id;

                $this->transactionDetailModel->insert($product);

                $previousQuantity = 0;
                foreach ($previousTransactionDetails as $previousTransactionDetail) {
                    if ($previousTransactionDetail['product_id'] == $product['product_id']) {
                        $previousQuantity = $previousTransactionDetail['quantity'];
                        break;
                    }
                }

                // Hitung perbedaan stok yang harus ditambah atau dikurangi
                $stockDifference = $product['quantity'] - $previousQuantity;

                // Jika quantity baru lebih besar, maka kurangi stok
                if ($stockDifference > 0) {
                    $newStock = $productData['stock'] - $stockDifference;
                }
                // Jika quantity baru lebih kecil, maka tambah stok
                elseif ($stockDifference < 0) {
                    $newStock = $productData['stock'] + abs($stockDifference);
                } else {
                    $newStock = $productData['stock'];
                }

                if ($newStock < 0) {
                    throw new \Exception('Stok produk ' . $productData['name'] . ' tidak cukup.');
                }

                $this->productModel->update($product['product_id'], ['stock' => $newStock]);
            }

            // Jika produk lama tidak ada di produk baru, artinya produk ini dihapus
            foreach ($previousTransactionDetails as $previousTransactionDetail) {
                $productFound = false;
                foreach ($postData['products'] as $product) {
                    if ($product['product_id'] == $previousTransactionDetail['product_id']) {
                        $productFound = true;
                        break;
                    }
                }

                if (!$productFound) {
                    $productData = $this->productModel->find($previousTransactionDetail['product_id']);
                    $newStock = $productData['stock'] + $previousTransactionDetail['quantity'];
                    $this->productModel->update($previousTransactionDetail['product_id'], ['stock' => $newStock]);
                }
            }

            $this->db->transCommit();

            return redirect()->to('/transactions')->with('success', 'Data transaksi berhasil diperbarui');
        } catch (\Exception $e) {
            $this->db->transRollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        $this->db->transBegin();

        try {
            // Ambil semua detail transaksi sebelum dihapus
            $transactionDetails = $this->transactionDetailModel->where('transaction_id', $id)->findAll();

            foreach ($transactionDetails as $detail) {
                $productData = $this->productModel->find($detail['product_id']);

                // Tambahkan quantity produk yang dihapus ke stok produk
                $newStock = $productData['stock'] + $detail['quantity'];

                $this->productModel->update($detail['product_id'], ['stock' => $newStock]);
            }

            $this->transactionDetailModel->where('transaction_id', $id)->delete();
            $this->transactionModel->delete($id);

            $this->db->transCommit();

            return redirect()->to('/transactions')->with('success', 'Data transaksi berhasil dihapus.');
        } catch (\Exception $e) {
            $this->db->transRollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function getRomanMonth($month)
    {
        $romanNumerals = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];

        return isset($romanNumerals[$month]) ? $romanNumerals[$month] : '';
    }
}
