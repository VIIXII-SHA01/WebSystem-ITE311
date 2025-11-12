<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true, 
                'unsigned'       => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'course_name' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
            ],
            /*'course_instructor' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
            ],*/
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('courses');
    }
    
    public function down()
    {
        $this->forge->dropTable('courses', true);
    }
}
?>