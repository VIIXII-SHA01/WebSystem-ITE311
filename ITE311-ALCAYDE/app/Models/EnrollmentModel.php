<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table      = 'enrollments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'course_id', 'enrolled_date'];
    protected $useTimestamps = false; // We are handling enrolled_date manually

    /**
     * Enroll a user in a course
     *
     * @param array $data ['user_id' => ..., 'course_id' => ..., 'enrolled_date' => ...]
     * @return bool|int Insert ID on success, false on failure
     */
    public function enrollUser(array $data)
    {
        // Optional: prevent duplicate enrollment before inserting
        if ($this->isAlreadyEnrolled($data['user_id'], $data['course_id'])) {
            return false;
        }

        // If 'enrolled_date' is not set, use current timestamp
        if (!isset($data['enrolled_date'])) {
            $data['enrolled_date'] = date('Y-m-d H:i:s');
        }

        return $this->insert($data);
    }

    /**
     * Get all courses a user is enrolled in
     *
     * @param int $user_id
     * @return array
     */
    public function getUserEnrollments(int $user_id)
    {
        return $this->select('courses.id, courses.course_name,
                                courses.course_instructor')
                ->join('courses', 'courses.id = enrollments.course_id')
                ->where('enrollments.user_id', $user_id)
                ->findAll();
    }

    /**
     * Check if a user is already enrolled in a specific course
     *
     * @param int $user_id
     * @param int $course_id
     * @return bool
     */
    public function isAlreadyEnrolled(int $user_id, int $course_id)
    {
        $enrollment = $this->where([
            'user_id'   => $user_id,
            'course_id' => $course_id,
        ])->first();

        return $enrollment !== null;
    }
}
