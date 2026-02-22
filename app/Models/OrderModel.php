<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['total_amount', 'status', 'user_id', 'payment_method', 'payment_proof', 'payment_date', 'shipping_name', 'shipping_phone', 'shipping_address', 'shipping_note'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // Not used in schema
    protected $deletedField  = ''; // Not used in schema
}
