<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class Auth extends Controller
{
    // --- User Registration ---
    public function register()
    {
        helper(['form']);
        $data = [];

        // Redirect logged-in users
        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url('dashboard'));
        }

        // Process only POST requests
        if ($this->request->is('post')) {
            $rules = [
                'name' => [
                    'label'  => 'Full Name',
                    'rules'  => 'required|min_length[3]|max_length[50]|regex_match[/^[A-Za-z\s]+$/]',
                    'errors' => [
                        'regex_match' => 'The {field} can only contain letters and spaces.'
                    ]
                ],
                'email' => [
                    'label'  => 'Email Address',
                    'rules'  => 'required|valid_email|is_unique[users.email]|regex_match[/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/]',
                    'errors' => [
                        'regex_match' => 'The {field} format is invalid.',
                        'is_unique'   => 'That email is already taken.'
                    ]
                ],
                'password' => [
                    'label'  => 'Password',
                    'rules'  => 'required|min_length[8]|max_length[255]|regex_match[/^(?!.*[\*"]).+$/]',
                    'errors' => [
                        'regex_match' => 'The {field} cannot contain * or ".'
                    ]
                ],
                'password_confirm' => 'matches[password]'
            ];
            $role = 'student';
            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                return view('auth/register', $data);
            }

            $userData = [
                'name'       => $this->request->getPost('name'),
                'email'      => $this->request->getPost('email'),
                'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role'       => $role,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $db = Database::connect();
            $inserted = $db->table('users')->insert($userData);

            if ($inserted) {
                session()->setFlashdata('success', 'Registration successful! Please log in.');
                return redirect()->to(base_url('login'));
            }

            $data['error'] = 'Registration failed. Please try again.';
        }

        return view('auth/register', $data);
    }

    // --- User Login ---
    public function login()
    {
        helper(['form']);
        $data = [];

        // Already logged in
        if (session()->get('LoggedIn')) {
            return redirect()->to(base_url('dashboard'));
        }

        if ($this->request->is('post')) {
            $rules = [
                'email'    => [
                        'label'  => 'Email Address',
                        'rules'  => 'required|valid_email|regex_match[/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/]',
                        'errors' => [
                            'regex_match' => 'The {field} format is invalid.',
                            'is_unique'   => 'That email is already taken.'
                        ]
                    ],
                'password' => [
                        'label'  => 'Password',
                        'rules'  => 'required|min_length[8]|max_length[255]|regex_match[/^(?!.*[\*"]).+$/]',
                        'errors' => [
                            'regex_match' => 'The {field} cannot contain * or ".'
                        ]
                    ],
            ];

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                return view('auth/login', $data);
            }

            $email    = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $db   = Database::connect();
            $user = $db->table('users')->where('email', $email)->get()->getRow();

            if (! $user) {
                session()->setFlashdata('error', 'Email not found.');
                return redirect()->back()->withInput();
            }

            if (! password_verify($password, $user->password)) {
                session()->setFlashdata('error', 'Incorrect email or password.');
                return redirect()->back()->withInput();
            }

            // Store session data
            session()->set([
                'user_id'        => $user->id,
                'user_name'      => $user->name,
                'user_email'     => $user->email,
                'user_role'      => $user->role ?? 'student',
                'status' => $user->account_status ?? 'granted',
                'LoggedIn'     => true,
            ]);

            return redirect()->to(base_url('dashboard'));
             if ($session->get('status') === 'restricted') {
              return redirect()->to(base_url('restricted/user'));
              
            }
        }

        return view('auth/login', $data);
    }

    // --- Dashboard Access ---
    public function dashboard()
    {
        $session = session();

        if (! $session->get('LoggedIn')) {
            $session->setFlashdata('error', 'Please log in first!');
            return redirect()->to(base_url('login'));
        }

        if ($session->get('status') === 'restricted') {
            $session->destroy();
            return redirect()->to(base_url('restricted/user'));
        }

        return view('auth/dashboard');
    }

    // --- Logout User ---
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
