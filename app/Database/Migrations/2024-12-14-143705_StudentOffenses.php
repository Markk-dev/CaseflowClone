<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StudentOffenses extends Migration
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
            'offense_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'offense_level' => [
                'type' => 'ENUM',
                'constraint' => ['First Offense', 'Second Offense', 'Third Offense'],
            ],
            'date_reported' => [
                'type' => 'DATE',
            ],
            'action_taken' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'reported_by' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);

        // Add Primary Key
        $this->forge->addKey('id', true);

        // Add Foreign Key for offense_id
        $this->forge->addForeignKey('offense_id', 'offense', 'id', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('student_offenses');
    }

    public function down()
    {
        $this->forge->dropTable('student_offenses');
    }
}
