<?php
namespace App\Controllers;

use App\Models\EnrollmentModel;
use App\Models\UserModel;
use App\Models\courseModel;
use CodeIgniter\API\ResponseTrait;

class adminCourse extends BaseController
{
    use ResponseTrait;

    public function enroll($courseId)
    {
        $enrollmentModel = new EnrollmentModel();
        $userModel = new UserModel();

        $students = $this->request->getPost('students'); // array of selected student IDs

        if (!$students || !is_array($students)) {
            return $this->fail('No students selected.');
        }

        $insertData = [];
        $currentDate = date('Y-m-d H:i:s');
        $academicYear = '2025-2026'; // You can dynamically calculate if needed
        $semester = '1';             // Example default value
        $term = '1';                 // Example default value

        foreach ($students as $studentId) {

            // Prevent duplicate enrollment
            $exists = $enrollmentModel
                ->where('user_id', $studentId)
                ->where('course_id', $courseId)
                ->first();

            if ($exists) continue; // skip already enrolled

            // Fetch student info (optional)
            $student = $userModel->find($studentId);
            $yearLevel = $student['year_level'] ?? null;

            $insertData[] = [
                'user_id' => $studentId,
                'course_id' => $courseId,
                'enrolled_date' => $currentDate,
                'academic_year' => $academicYear,
                'semester' => $semester,              // lowercase, matches table
                'term' => $term,
                'year_level' => $yearLevel,           // lowercase
                'enrollment_status' => 'active',
                'control_number' => null,             // lowercase
            ];
        }

        if (!empty($insertData)) {
            try {
                $enrollmentModel->insertBatch($insertData);
            } catch (\Exception $e) {
                return $this->fail('Failed to enroll students: ' . $e->getMessage());
            }
        }

        return $this->respond([
            'status' => 'success',
            'message' => 'Students enrolled successfully!'
        ]);
    }

    public function delete($courseId)
    {
        $courseModel = new CourseModel();

        // Check if course exists
        $course = $courseModel->find($courseId);
        if (!$course) {
            return redirect()->back()->with('error', 'Course not found.');
        }

        try {
            $courseModel->delete($courseId);
            return redirect()->back()->with('success', 'Course deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete course: ' . $e->getMessage());
        }
    }
}
