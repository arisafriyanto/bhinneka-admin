<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionDetailModel extends Model
{
    protected $table            = 'transaction_details';
    protected $protectFields    = true;
    protected $allowedFields    = ['transaction_id', 'product_id', 'quantity', 'price', 'subtotal_price'];
}
