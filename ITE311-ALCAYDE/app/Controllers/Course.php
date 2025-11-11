<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;
use App\Models\courseModel;
use CodeIgniter\Controller;

class Course extends Controller
{
    /**
     * Handle AJAX enrollment request
     */
    public function enroll() {
        $session = session();

        if (! $session->get('LoggedIn')) {
            $session->setFlashdata('error', 'Please log in first!');
            return redirect()->to(base_url('login'));
        }

        // ✅ Check if user_id exists
        if (!$session->has('user_id')) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'You must be logged in to enroll in a course.',
                'csrfHash' => csrf_hash() // always return updated CSRF token
            ]);
        }

        // ✅ Get user_id and course_id
        $user_id   = $session->get('user_id');
        $course_id = $this->request->getPost('course_id');

        if (!$course_id) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Invalid course ID.',
                'csrfHash' => csrf_hash()
            ]);
        }

        // ✅ Load Enrollment Model
        $enrollmentModel = new \App\Models\EnrollmentModel();

        // ✅ Check if user already enrolled
        if ($enrollmentModel->isAlreadyEnrolled($user_id, $course_id)) {
            return $this->response->setJSON([
                'status'  => 'warning',
                'message' => 'You are already enrolled in this course.',
                'csrfHash' => csrf_hash()
            ]);
        }

        // ✅ Insert new enrollment record
        $data = [
            'user_id'         => $user_id,
            'course_id'       => $course_id,
            'enrollment_date' => date('Y-m-d H:i:s'),
        ];

        $inserted = $enrollmentModel->enrollUser($data);

        if ($inserted) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Enrolled successfully!',
                'csrfHash' => csrf_hash() // updated token for next request
            ]);
        }

        // ✅ Handle insert failure
        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Enrollment failed. Please try again.',
            'csrfHash' => csrf_hash()
        ]);
    }


    public function studentCourses() {
       $session = session();

        // ✅ 1. Check if user is logged in
        if (!$session->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        $user_id = $session->get('user_id');

        // ✅ 2. Load models
        $enrollmentModel = new EnrollmentModel();
        $courseModel     = new courseModel();

        // ✅ 3. Get enrolled courses (joined with course names)
        $enrollments = $enrollmentModel->getUserEnrollments($user_id);

        // ✅ 4. Get all available courses
        $allCourses = $courseModel->findAll();

        // ✅ 5. Filter out already-enrolled courses
        $enrolledIds = array_column($enrollments, 'course_id');
        $availableCourses = array_filter($allCourses, function ($course) use ($enrolledIds) {
            return !in_array($course['id'], $enrolledIds);
        });

        // ✅ 6. Load the view
        return view('students/myCourses', [
            'enrollments'      => $enrollments,
            'availableCourses' => $availableCourses
        ]);
    }
}
