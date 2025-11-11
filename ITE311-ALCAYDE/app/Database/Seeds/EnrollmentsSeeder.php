<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EnrollmentsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id'      => 1,
                'course_id'    => 6,
                'enrolled_date' => '2024-01-15 10:00:00',
            ],
            [
                'user_id'      => 2,
                'course_id'    => 4,
                'enrolled_date' => '2024-02-20 14:30:00',
            ],
            [
                'user_id'      => 3,
                'course_id'    => 5,
                'enrolled_date' => '2024-03-05 09:15:00',
            ],
        ];
        // Using Query Builder
       $this->db->table('enrollments')->insertBatch($data);
    }
}
