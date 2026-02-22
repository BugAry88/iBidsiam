<?php

namespace App\Models;

use CodeIgniter\Model;

class AddressModel extends Model
{
    protected $table            = 'addresses';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'type', 'recipient_name', 'phone', 'address_line1', 
        'address_line2', 'city', 'province', 'postal_code', 'country', 
        'is_default', 'created_at', 'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [
        'user_id'        => 'required|integer',
        'type'           => 'required|in_list[shipping,billing]',
        'recipient_name' => 'required|min_length[3]|max_length[100]',
        'phone'          => 'required|min_length[10]|max_length[20]',
        'address_line1'  => 'required|min_length[5]|max_length[255]',
        'city'           => 'required|min_length[2]|max_length[100]',
        'province'       => 'required|min_length[2]|max_length[100]',
        'postal_code'    => 'required|min_length[5]|max_length[20]',
        'country'        => 'required|min_length[2]|max_length[100]'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;

    /**
     * Get user's addresses
     */
    public function getUserAddresses($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('is_default', 'DESC')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get user's default address by type
     */
    public function getDefaultAddress($userId, $type = 'shipping')
    {
        return $this->where(['user_id' => $userId, 'type' => $type, 'is_default' => 1])->first();
    }

    /**
     * Set address as default
     */
    public function setAsDefault($addressId, $userId, $type)
    {
        // Remove default status from other addresses of same type
        $this->where(['user_id' => $userId, 'type' => $type])
             ->set(['is_default' => 0])
             ->update();
        
        // Set this address as default
        return $this->update($addressId, ['is_default' => 1]);
    }

    /**
     * Add new address
     */
    public function addAddress($data)
    {
        // If this is the first address of this type, make it default
        $existingAddresses = $this->where([
            'user_id' => $data['user_id'], 
            'type' => $data['type']
        ])->countAllResults();
        
        if ($existingAddresses === 0) {
            $data['is_default'] = 1;
        }
        
        return $this->insert($data);
    }

    /**
     * Update address
     */
    public function updateAddress($addressId, $userId, $data)
    {
        // Verify address belongs to user
        $address = $this->where(['id' => $addressId, 'user_id' => $userId])->first();
        if (!$address) {
            return false;
        }
        
        return $this->update($addressId, $data);
    }

    /**
     * Delete address
     */
    public function deleteAddress($addressId, $userId)
    {
        $address = $this->where(['id' => $addressId, 'user_id' => $userId])->first();
        if (!$address) {
            return false;
        }
        
        // If this was the default address, set another as default
        if ($address['is_default']) {
            $nextAddress = $this->where([
                'user_id' => $userId, 
                'type' => $address['type'],
                'id !=' => $addressId
            ])->first();
            
            if ($nextAddress) {
                $this->update($nextAddress['id'], ['is_default' => 1]);
            }
        }
        
        return $this->delete($addressId);
    }

    /**
     * Get formatted address string
     */
    public function getFormattedAddress($address)
    {
        $parts = [
            $address['address_line1'],
            $address['address_line2'],
            $address['city'],
            $address['province'] . ' ' . $address['postal_code'],
            $address['country']
        ];
        
        return implode(', ', array_filter($parts));
    }
}
