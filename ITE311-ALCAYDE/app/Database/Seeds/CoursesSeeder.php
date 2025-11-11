<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CoursesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'course_name' => 'Introduction to Programming',
                'course_instructor' => 'John Doe',
            ],
            [
                'course_name' => 'Web Development Basics',
                'course_instructor' => 'Jane Smith',
            ],
            [
                'course_name' => 'Database Management Systems',
                'course_instructor' => 'Alice Johnson',
            ],
        ];

        // Using Query Builder
        foreach ($data as $course) {
            $this->db->table('courses')->insert($course);
        }
    }
}
