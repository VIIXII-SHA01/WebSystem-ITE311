<?php

namespace App\Controllers;

use App\Models\courseModel;
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
        $courseModel  = new CourseModel();
        $teacherModel = new TeacherModel();

        // Get all courses
        $courses = $courseModel->findAll();

        // Get all teachers with role 'teacher' and status 'granted'
        $teachers = $teacherModel->where('role', 'teacher')
                    ->where('status', 'granted')
                    ->findAll();

        // Pass data to view
        return view('admin/courseManage', [
            'courses'  => $courses,
            'teachers' => $teachers
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

            // Data to insert
            $data = [
                'course_name'       => $course_name,
                'course_code'       => $course_code,
                'course_instructor' => $course_instructor ?: null
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
        return view('admin/adminEnroll');
    }

}
