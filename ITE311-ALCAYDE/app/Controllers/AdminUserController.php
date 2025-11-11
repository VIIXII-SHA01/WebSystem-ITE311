<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AdminUserController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->userModel = new UserModel();
    }

    // 🟢 Show User Management Page
    public function index()
    {
        if (!session()->get('LoggedIn') || session()->get('user_role') !== 'admin') {
        return redirect()->to(base_url('login'))->with('error', 'Access denied.');
    }

    $data['users'] = $this->userModel->findAll();

    // Make sure this matches your actual file name (case-sensitive on Linux)
    return view('allUser', $data);
    }

    // 🟩 Add New User
    public function addUser()
    {
        helper(['form']);
        $message = [];
        if($this->request->is('post')) {
             $validationRules = [
            'name'     => [
                    'label'  => 'Full Name',
                    'rules'  => 'min_length[3]|max_length[50]|regex_match[/^[A-Za-z\s]+$/]', // Name must be required and match regex
                    'errors' => [
                        'regex_match' => 'The {field} may only contain letters and spaces.' // Custom error message for regex match
                    ]
            ],
            'email'    => [
                    'label'  => 'Email Address',
                    'rules'  => 'valid_email|is_unique[users.email]|regex_match[/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/]', // Email must be valid
                    'errors' => [
                        'regex_match' => 'The {field} contains invalid characters.' // Custom error message for regex match
                    ],
                ],
            'role'     =>  [
                    'label'  => 'User Role',
                    'rules'  => 'in_list[admin,teacher,student]', // Role must be one of the specified values
                    'errors' => [
                        'in_list' => 'The {field} must be either admin, teacher, or student.' // Custom error message for role validation
                    ]
                ],
        ];
        $password = "password123";
        $message = "Please Enter a Valid Data";
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors',  $message);
        }

        $this->userModel->insert([
            'name'       => $this->request->getPost('name'),
            'email'      => $this->request->getPost('email'),
            'password'   => password_hash($password, PASSWORD_DEFAULT),
            'role'       => $this->request->getPost('role'),
            'account_status'     => 'granted',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(base_url('users'))->with('success', 'User added successfully!');
        
        }
    }

    // 🟨 Update User Info
    public function updateUser($id)
    {
         $validationRules = [
            'name'     => [
                    'label'  => 'Full Name',
                    'rules'  => 'required|min_length[3]|max_length[50]|regex_match[/^[A-Za-z\s]+$/]', // Name must be required and match regex
                    'errors' => [
                        'regex_match' => 'The {field} may only contain letters and spaces.' // Custom error message for regex match
                    ]
            ],
            'role'     =>  [
                    'label'  => 'User Role',
                    'rules'  => 'required|in_list[admin,teacher,student]', // Role must be one of the specified values
                    'errors' => [
                        'in_list' => 'The {field} must be either admin, teacher, or student.' // Custom error message for role validation
                    ]
                ],
        ];

        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

         $password = "password123";
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name'  => $this->request->getPost('name'),
            'role'  => $this->request->getPost('role'),
            'account_status'=> $this->request->getPost('status'),
            'password'   => password_hash($password, PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->userModel->update($id, $data);
        return redirect()->to(base_url('users'))->with('success', 'User updated successfully!');
    }

    // 🟥 Restrict or Unrestrict User
    public function toggleRestriction($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $newStatus = $user['account_status'] === 'granted' ? 'restricted' : 'granted';
        $this->userModel->update($id, ['account_status' => $newStatus]);

        $msg = $newStatus === 'restricted' ? 'User restricted.' : 'User access restored.';
        return redirect()->to(base_url('users'))->with('success', $msg);
    }
}
