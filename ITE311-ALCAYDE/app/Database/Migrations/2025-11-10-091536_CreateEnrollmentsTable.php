<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEnrollmentsTable extends Migration
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
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'course_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'enrolled_date' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'academic_year' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
            ],
            'Control_Number' => [
                'type' => 'INT',
                'constraint' => 10,
                'null' => false,
            ],
            'Semester' => [
                'type' => 'ENUM',
                'constraint' => [1, 2],
                'null' => false,
            ],
            'Year_Level' => [
                'type' => 'ENUM',
                'constraint' => ['1st Year', '2nd Year', '3rd Year', '4th Year'],
                'null' => false,
            ],
            'enrollment_status' => [
                'type' => 'ENUM',
                'constraint' => ['active', 'completed', 'dropped', 'failed'],
                'default' => 'active',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('course_id', 'courses', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('enrollments');
    }

    public function down()
    {
        $this->forge->dropTable('enrollments', true);
    }
}
