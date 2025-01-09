<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table            = 'transactions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['invoice_number', 'user_id', 'total_quantity', 'total_price'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getTransactionsWithUser()
    {
        return $this->select('transactions.*, users.name AS buyer_name')
            ->join('users', 'users.id = transactions.user_id')
            ->orderBy('transactions.created_at', 'desc')
            ->findAll();
    }
}
