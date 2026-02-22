<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Cron extends BaseController
{
    /**
     * Check for low stock products and send email alerts
     * This can be run via cron job or manually
     */
    public function checkLowStock()
    {
        $productModel = new ProductModel();
        $emailService = new \App\Libraries\EmailService();
        
        // Define low stock threshold
        $lowStockThreshold = 5;
        
        // Get products with low stock
        $lowStockProducts = $productModel
            ->where('quantity <=', $lowStockThreshold)
            ->where('quantity >', 0)
            ->findAll();
        
        if (!empty($lowStockProducts)) {
            foreach ($lowStockProducts as $product) {
                try {
                    $emailService->sendAdminLowStockAlert($product);
                    log_message('info', 'Low stock alert sent for product: ' . $product['name']);
                } catch (\Exception $e) {
                    log_message('error', 'Failed to send low stock alert: ' . $e->getMessage());
                }
            }
            
            echo "Low stock alerts sent for " . count($lowStockProducts) . " products.\n";
        } else {
            echo "No low stock products found.\n";
        }
    }
    
    /**
     * Check stock after order is placed
     * This is called automatically after each order
     */
    public function checkStockAfterOrder($productId)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($productId);
        
        if ($product && $product['quantity'] <= 5 && $product['quantity'] > 0) {
            try {
                $emailService = new \App\Libraries\EmailService();
                $emailService->sendAdminLowStockAlert($product);
                log_message('info', 'Low stock alert sent for product after order: ' . $product['name']);
            } catch (\Exception $e) {
                log_message('error', 'Failed to send low stock alert after order: ' . $e->getMessage());
            }
        }
    }
}
