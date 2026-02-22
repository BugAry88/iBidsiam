<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmailLogsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'recipient' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'subject' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
            ],
            'template' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['sent', 'failed'],
                'default'    => 'sent',
            ],
            'error_message' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'sent_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addKey('recipient');
        $this->forge->addKey('status');
        $this->forge->addKey('sent_at');
        $this->forge->createTable('email_logs');
    }

    public function down()
    {
        $this->forge->dropTable('email_logs');
    }
}
