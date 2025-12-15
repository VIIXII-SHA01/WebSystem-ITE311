<?php

namespace App\Controllers;

use App\Models\courseModel;
use CodeIgniter\Controller;

class TeacherCourses extends BaseController
{
    public function createCourse()
    {
        $request = $this->request;

        if ($request->is('post')) {
            $courseModel = new courseModel();

            $courseData = [
                'course_name'       => $request->getPost('course_name'),
                'course_instructor' => session()->get('user_name'), // instructor from session
                'course_code'       => $request->getPost('course_code'),
                'course_description'=> $request->getPost('course_description'),
                'credits'           => $request->getPost('credits')
            ];

            $courseModel->insert($courseData);

            return redirect()->to('/teacher/classes')
                             ->with('success', 'Course created successfully!');
        }

        return view('teacher/addCourse'); // your form view
    }
}
