<?php

namespace App\Controllers;

use App\Models\courseModel;
use App\Models\UserModel;
use App\Models\EnrollmentModel;
use App\Models\teacherModel;
use App\Models\UsersModel; // <- Add this line\
use Config\Database;


class Home extends BaseController
{
    public function index(): string
    {
        return view('students/myCourses');
    }
      public function about(): string
    {
        return view('about');
    }
      public function contact(): string
    {
        return view('contact');
    }
     public function allUsers(): string
    {
        return view('allUser');
    }
    public function myClasses(): string
    {
        return view('teacher/myClasses');
    }
   public function courseUpload()
    {
        return view('admin/upload');
    }

    public function tCourse(): string
    {
         $userModel = new UserModel();

        // Fetch all users where role = 'student'
        $students = $userModel->where('role', 'student')->findAll();

        // Pass students to the view
        return view('teacher/addCourse', [
            'students' => $students
        ]);
    }
    public function restricted(): string
    {
        return view('restricted');
    }
     public function notFound() {
        return view('error_page');
    }
     public function courseAdmin()
    {
        if(! session()->get('LoggedIn') || session()->get('user_role') != 'admin') {
            return redirect()->to(base_url('/dashboard'))->with('error', 'You must be logged in as an admin to access that page.');
        }
        $courseModel  = new courseModel();
        $teacherModel = new TeacherModel();
        $userModel = new UserModel();
        $enrollmentModel = new EnrollmentModel();

        // Get all courses
        $courses = $courseModel->getAllCourses();
        $teachers = $userModel->where('role', 'teacher')->findAll();
        $students = $userModel->where('role', 'student')->findAll();

        $enrollments = $enrollmentModel->findAll();  

        // Get all teachers with role 'teacher' and status 'granted'
        $teachers = $teacherModel->where('role', 'teacher')
                    ->where('status', 'granted')
                    ->findAll();

        // Pass data to view
        return view('admin/courseManage', [
            'courses' => $courses,
            'teachers' => $teachers,
            'students' => $students,
            'enrollments' => $enrollments
        ]);
    }

     public function addCourse()
    {
        helper(['form']);

        // Only admin can add course
        if (!session()->get('LoggedIn') || session()->get('user_role') != 'admin') {
            return redirect()->to(base_url('/dashboard'))
                            ->with('error', 'You must be logged in as an admin to access that page.');
        }

        if ($this->request->is('post')) {

            // Validation rules
            $rules = [
                'course_name' => [
                    'rules'  => 'required|min_length[2]|max_length[255]|regex_match[/^[A-Za-z0-9\s\-]+$/]',
                    'errors' => [
                        'regex_match' => 'Course name can only contain letters, numbers, spaces, and dashes.'
                    ]
                ],
                'course_code' => [
                    'rules'  => 'required|alpha_numeric|min_length[2]|max_length[20]',
                    'errors' => [
                        'alpha_numeric' => 'Course code can only contain letters and numbers.'
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()
                                ->withInput()
                                ->with('error', 'Please check the highlighted errors.')
                                ->with('errors', $this->validator->getErrors());
            }

            // Get POST inputs
            $course_name       = $this->request->getPost('course_name');
            $course_code       = $this->request->getPost('course_code');
            $course_instructor = $this->request->getPost('course_instructor');
            $course_description = $this->request->getPost('course_description');
            $credits = $this->request->getPost('credits');

            // Data to insert
            $data = [
                'course_name'       => $course_name,
                'course_code'       => $course_code,
                'course_instructor' => $course_instructor ?: null,
                'course_description'=> $course_description,
                'credits'           => $credits 
            ];

            // Insert into DB
            $db = Database::connect();
            $insert = $db->table('courses')->insert($data);

            if (!$insert) {
                return redirect()->to(base_url('/course/admin'))
                                ->with('error', 'Error Adding Course.');
            }

            return redirect()->to(base_url('/course/admin'))
                            ->with('success', 'Course added successfully.');
        }

        return redirect()->to(base_url('/course/admin'));
    }
    public function adminEnroll() {
        $enrollmentModel = new EnrollmentModel();
        $userModel = new UserModel();
        $courseModel = new CourseModel();

        return view('admin/adminEnroll', [
            'pending'  => $enrollmentModel->getPendingEnrollments(),
            'approved' => $enrollmentModel->getApprovedEnrollments(),
            'all'      => $enrollmentModel->getAllEnrollments(),

            // Add dynamic dropdown data
            'students' => $userModel->where('role', 'student')->findAll(),
            'courses'  => $courseModel->findAll(),
        ]);
    }

    public function enrollStudent() {
        $enrollModel = new EnrollmentModel();

        $student_id = $this->request->getPost('student_id');
        $course_id  = $this->request->getPost('course_id');

        // Prevent duplicate enrollment
        $existing = $enrollModel->where([
            'user_id' => $student_id,
            'course_id' => $course_id,
        ])->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Student is already enrolled in this course.');
        }

        // Save enrollment
        $enrollModel->insert([
            'user_id'          => $student_id,
            'course_id'        => $course_id,
            'Year_Level'       => $this->request->getPost('year_level'),
            'academic_year'    => $this->request->getPost('academic_year'),
            'Control_Number'   => $this->request->getPost('control_number'),
            'term'             => $this->request->getPost('term'),
            'enrollment_status'=> $this->request->getPost('status'),
            'enrolled_date'    => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Student enrolled successfully.');
    }


}
