<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CompleteCases extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'case_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'completed_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('complete_cases');
    }

    public function down()
    {
        $this->forge->dropTable('complete_cases');
    }
} 