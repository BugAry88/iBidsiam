<?php

namespace App\Models;

use CodeIgniter\Model;

class WishlistModel extends Model
{
    protected $table            = 'wishlists';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'product_id', 'created_at'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [
        'user_id'    => 'required|integer',
        'product_id' => 'required|integer'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;

    /**
     * Get user's wishlist items with product details
     */
    public function getUserWishlist($userId)
    {
        return $this->select('wishlists.*, products.name, products.price, products.image, products.description')
                    ->join('products', 'products.id = wishlists.product_id')
                    ->where('wishlists.user_id', $userId)
                    ->orderBy('wishlists.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Check if product is in user's wishlist
     */
    public function isInWishlist($userId, $productId)
    {
        return $this->where(['user_id' => $userId, 'product_id' => $productId])->first() !== null;
    }

    /**
     * Add product to wishlist
     */
    public function addToWishlist($userId, $productId)
    {
        // Check if already in wishlist
        if ($this->isInWishlist($userId, $productId)) {
            return false;
        }

        return $this->insert([
            'user_id'    => $userId,
            'product_id' => $productId
        ]);
    }

    /**
     * Remove product from wishlist
     */
    public function removeFromWishlist($userId, $productId)
    {
        return $this->where(['user_id' => $userId, 'product_id' => $productId])->delete();
    }

    /**
     * Get wishlist count for user
     */
    public function getWishlistCount($userId)
    {
        return $this->where('user_id', $userId)->countAllResults();
    }

    /**
     * Move item from wishlist to cart
     */
    public function moveToCart($userId, $productId)
    {
        if ($this->removeFromWishlist($userId, $productId)) {
            // Add to cart logic would be handled by the Cart controller
            return true;
        }
        return false;
    }
}
