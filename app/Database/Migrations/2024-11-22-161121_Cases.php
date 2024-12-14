<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cases extends Migration 
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'case_type' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'case_priority' => [
                'type' => 'ENUM',
                'constraint' => ['High', 'Medium', 'Low'],
            ],
            'progress' => [
                'type' => 'ENUM',
                'constraint' => ['Complete', 'Incomplete'],
                'default' => 'Incomplete',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cases');
    }
    
    public function down()
    {
        $this->forge->dropTable('cases');
    }
    
}