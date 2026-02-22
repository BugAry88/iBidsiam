<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'email', 'password', 'role', 'address', 'phone'];

    // Dates
    protected $useTimestamps = false; // Using database defaults for now
    
    // Validation
    protected $validationRules = [
        'name'     => 'required|min_length[3]',
        // 'email' validation moved to Controller to handle unique check dynamically
    ];
    
    protected $validationMessages = [];
}
