<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateProductStatusEnum extends Migration
{
    public function up()
    {
        // Modify status column to include special_pre_order
        $this->db->query("ALTER TABLE products MODIFY status ENUM('in_stock','out_of_stock','pre_order','special_pre_order','available_order') DEFAULT 'in_stock'");
    }

    public function down()
    {
        // Revert to original ENUM values
        $this->db->query("ALTER TABLE products MODIFY status ENUM('in_stock','out_of_stock','pre_order','available_order') DEFAULT 'in_stock'");
    }
}
