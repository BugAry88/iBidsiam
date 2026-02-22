<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentSettingModel extends Model
{
    protected $table            = 'payment_settings';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['method_name', 'details', 'is_active'];
    protected $returnType       = 'array';
}
