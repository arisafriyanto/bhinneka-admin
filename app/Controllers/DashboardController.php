<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\ProductModel;
use CodeIgniter\Controller;

class DashboardController extends Controller
{
    protected $transactionModel;
    protected $productModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        // Total transaksi
        $totalTransactions = $this->transactionModel->countAll();

        // Total penjualan (dalam Rp)
        $totalSalesAmount = $this->transactionModel->selectSum('total_price')->first()['total_price'];

        // Total qty item terjual
        $totalQtySold = $this->transactionModel->selectSum('total_quantity')->first()['total_quantity'];

        // Penjualan produk terbanyak
        $topProducts = $this->transactionModel
            ->select('products.name, SUM(transaction_details.quantity) AS total_qty')
            ->join('transaction_details', 'transactions.id = transaction_details.transaction_id')
            ->join('products', 'transaction_details.product_id = products.id')
            ->groupBy('products.name')
            ->orderBy('total_qty', 'DESC')
            ->limit(5)
            ->findAll();

        // Menyusun data untuk chart
        $productNames = array_column($topProducts, 'name');
        $productSales = array_column($topProducts, 'total_qty');

        // Mengirim data ke view
        return view('dashboard', [
            'totalTransactions' => $totalTransactions,
            'totalSalesAmount' => $totalSalesAmount,
            'totalQtySold' => $totalQtySold,
            'productNames' => json_encode($productNames),
            'productSales' => json_encode($productSales),
        ]);
    }
}
