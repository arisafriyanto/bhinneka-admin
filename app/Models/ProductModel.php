<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['unit_id', 'code', 'name', 'price', 'stock'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getProductsWithUnits()
    {
        return $this->select('products.*, units.name as unit_name')
            ->join('units', 'units.id = products.unit_id', 'left')
            ->findAll();
    }
}
