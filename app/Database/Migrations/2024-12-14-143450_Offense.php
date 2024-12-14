<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Offense extends Migration 
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
            'offense_type' => [ // Updated from case_type
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'name' => [ // Added name field
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'severity' => [ // Updated from case_priority
                'type' => 'ENUM',
                'constraint' => ['1st', '2nd', '3rd'], // Updated values
            ],
            'progress' => [
                'type' => 'ENUM',
                'constraint' => ['Complete', 'Incomplete'],
                'default' => 'Incomplete',
            ],
            'user_id' => [
                'type' => 'INT',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('offense'); // Renamed table
    }
    
    public function down()
    {
        $this->forge->dropTable('offense'); // Renamed table
    }
}
