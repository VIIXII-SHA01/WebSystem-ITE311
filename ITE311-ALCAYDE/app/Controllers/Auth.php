<?php
// This is the opening PHP tag, indicating the start of PHP code execution.

namespace App\Controllers;
// This declares the namespace for the controller class, organizing it under App\Controllers for better code structure and autoloading.

use CodeIgniter\Controller;
// This imports the base Controller class from CodeIgniter, which this class extends to inherit controller functionality.

use Config\Database;
// This imports the Database configuration class from CodeIgniter, allowing direct database connections.
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Auth extends Controller
// This defines the Auth class, which extends the base Controller class, making it a controller for handling authentication-related actions like registration, login, etc.

{
// This is the opening brace for the class definition.

    // --- User Registration ---
// This is a comment indicating the start of the user registration method.

    public function register()
// This defines the register method for handling user registration.

    {
// This is the opening brace for the register method.

        helper(['form']);
// This loads the 'form' helper from CodeIgniter, providing utility functions for form handling.

        $data = [];
// This initializes an empty array for data to be passed to the view.

        // Redirect logged-in users
// This is a comment explaining the following check: to redirect users who are already logged in.

        if (session()->get('isLoggedIn')) {
// This checks if the user is already logged in by checking the 'isLoggedIn' session variable.

            return redirect()->to(base_url('dashboard'));
// This redirects logged-in users to the dashboard page.

        }
// This is the closing brace for the if statement.

        // Process only POST requests
// This is a comment indicating that the following code processes only POST requests (form submissions).

        if ($this->request->is('post')) {
// This checks if the current request is a POST request.

            $rules = [
// This starts the array definition for validation rules for the registration form.

                'name' => [
// This defines validation rules for the 'name' field.

                    'label'  => 'Full Name',
// This sets the label for the 'name' field for error messages.

                    'rules'  => 'required|min_length[3]|max_length[50]|regex_match[/^[A-Za-z\s]+$/]',
// This specifies the validation rules: required, minimum 3 characters, maximum 50, and must match the regex for letters and spaces.

                    'errors' => [
// This starts the array for custom error messages for the 'name' field.

                        'regex_match' => 'The {field} can only contain letters and spaces.'
// This defines a custom error message for regex mismatch.

                    ]
// This closes the 'name' field array.

                ],
                'email' => [
// This defines validation rules for the 'email' field.

                    'label'  => 'Email Address',
// This sets the label for the 'email' field.

                    'rules'  => 'required|valid_email|is_unique[users.email]|regex_match[/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/]',
// This specifies rules: required, valid email, unique in users table, and match email regex.

                    'errors' => [
// This starts the array for custom error messages for the 'email' field.

                        'regex_match' => 'The {field} format is invalid.',
// Custom error for regex mismatch.

                        'is_unique'   => 'That email is already taken.'
// Custom error for non-unique email.

                    ]
// This closes the 'email' field array.

                ],
                'password' => [
// This defines validation rules for the 'password' field.

                    'label'  => 'Password',
// This sets the label for the 'password' field.

                    'rules'  => 'required|min_length[8]|max_length[255]|regex_match[/^(?!.*[\*"]).+$/]',
// This specifies rules: required, minimum 8 characters, maximum 255, and cannot contain * or ".

                    'errors' => [
// This starts the array for custom error messages for the 'password' field.

                        'regex_match' => 'The {field} cannot contain * or ".'
// Custom error for regex mismatch.

                    ]
// This closes the 'password' field array.

                ],
                'password_confirm' => 'matches[password]'
// This specifies that 'password_confirm' must match the 'password' field.

            ];
// This closes the $rules array.

            $role = 'student';
// This sets the default role for new users to 'student'.

            if (! $this->validate($rules)) {
// This validates the POST data against the rules; if invalid, proceeds to handle errors.

                $data['validation'] = $this->validator;
// This assigns the validator object to the data array for displaying errors in the view.

                return view('auth/register', $data);
// This returns the registration view with validation errors.

            }
// This closes the if statement for validation failure.

            $userData = [
// This starts the array for new user data to be inserted into the database.

                'name'       => $this->request->getPost('name'),
// This retrieves the 'name' from the POST data.

                'email'      => $this->request->getPost('email'),
// This retrieves the 'email' from the POST data.

                'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
// This hashes the password using PHP's password_hash function.

                'role'       => $role,
// This sets the role to the default 'student'.

                'status'     => 'restricted',
// This sets the initial status to 'granted'.

                'created_at' => date('Y-m-d H:i:s'),
// This sets the creation timestamp to the current date and time.

                'updated_at' => date('Y-m-d H:i:s'),
// This sets the update timestamp to the current date and time.

            ];
// This closes the $userData array.

            $db = Database::connect();
// This connects to the database using CodeIgniter's Database configuration.

            $inserted = $db->table('users')->insert($userData);
// This inserts the new user data into the 'users' table and stores the result (true/false) in $inserted.

            if ($inserted) {
// This checks if the insertion was successful.

                session()->setFlashdata('success', 'Registration successful! Please log in.');
// This sets a success flash message in the session.

                return redirect()->to(base_url('login'));
// This redirects to the login page.

            }
// This closes the if statement for successful insertion.

            $data['error'] = 'Registration failed. Please try again.';
// This sets an error message in the data array if insertion failed.

        }
// This closes the if statement for POST requests.

        return view('auth/register', $data);
// This returns the registration view, either initially or after errors.

    }
// This is the closing brace for the register method.

    // --- User Login ---
// This is a comment indicating the start of the user login method.

    public function login()
// This defines the login method for handling user login.

    {
// This is the opening brace for the login method.

        helper(['form']);
// This loads the 'form' helper.

        $data = [];
// This initializes an empty array for data.

        // Already logged in
// This is a comment explaining the check for already logged-in users.

        if (session()->get('LoggedIn')) {
// This checks if the user is already logged in (note: uses 'LoggedIn' instead of 'isLoggedIn' as in register).

            return redirect()->to(base_url('dashboard'));
// This redirects to the dashboard if already logged in.

        }
// This closes the if statement.

        if ($this->request->is('post')) {
// This checks if the request is POST.

            $rules = [
// This starts the validation rules array for login.

                'email'    => [
// This defines rules for 'email'.

                        'label'  => 'Email Address',
// Label for 'email'.

                        'rules'  => 'required|valid_email|regex_match[/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/]',
// Rules: required, valid email, match regex.

                        'errors' => [
// Custom errors.

                            'regex_match' => 'The {field} format is invalid.',
// Custom error.

                            'is_unique'   => 'That email is already taken.'
// Note: 'is_unique' error is defined but not used in login rules; probably a copy-paste remnant.

                        ]
// Closes 'email' errors.

                    ],
                'password' => [
// Defines rules for 'password'.

                        'label'  => 'Password',
// Label.

                        'rules'  => 'required|min_length[8]|max_length[255]|regex_match[/^(?!.*[\*"]).+$/]',
// Rules: required, min 8, max 255, no * or ".

                        'errors' => [
// Custom errors.

                            'regex_match' => 'The {field} cannot contain * or ".'
// Custom error.

                        ]
// Closes 'password' errors.

                    ],
            ];
// Closes $rules.

            if (! $this->validate($rules)) {
// Validates; if invalid, handles errors.

                $data['validation'] = $this->validator;
// Assigns validator to data.

                return view('auth/login', $data);
// Returns login view with errors.

            }
// Closes if.

            $email    = $this->request->getPost('email');
// Retrieves email from POST.

            $password = $this->request->getPost('password');
// Retrieves password from POST.

            $db   = Database::connect();
// Connects to database.

            $user = $db->table('users')->where('email', $email)->get()->getRow();
// Queries the 'users' table for the email and gets the first row.

            if (! $user) {
// Checks if user exists.

                session()->setFlashdata('error', 'Email not found.');
// Sets error flash message.

                return redirect()->back()->withInput();
// Redirects back with input preserved.

            }
// Closes if.

            if (! password_verify($password, $user->password)) {
// Verifies the password against the hashed password.

                session()->setFlashdata('error', 'Incorrect email or password.');
// Sets error flash message for wrong password.

                return redirect()->back()->withInput();
// Redirects back with input.

            }
// Closes if.

            // Store session data
// This is a comment explaining the session data storage.

            session()->set([
// This starts setting multiple session variables.

                'user_id'        => $user->id,
// Sets user ID in session.

                'user_name'      => $user->name,
// Sets user name.

                'user_email'     => $user->email,
// Sets user email.

                'user_role'      => $user->role ?? 'student',
// Sets user role, defaulting to 'student' if null.

                'status' => $user->status ?? 'granted',
// Sets status, defaulting to 'granted'.

                'LoggedIn'     => true,
// Sets 'LoggedIn' to true.

            ]);
// Closes the session set array.

            return redirect()->to(base_url('dashboard'));
// This redirects to the dashboard after successful login.

             if ($session->get('status') === 'restricted') {
// Note: This if statement is placed after the return, so it will never execute. It seems like a misplaced code block, possibly intended to be before the redirect or in the dashboard method.

              return redirect()->to(base_url('restricted/user'));
// This would redirect restricted users, but due to placement, it's unreachable.

              
            }
// Closes the if (though unreachable).

        }
// Closes the POST if.

        return view('auth/login', $data);
// Returns the login view.

    }
// This is the closing brace for the login method.

    // --- Dashboard Access ---
// This is a comment indicating the dashboard access method.

    public function dashboard()
// This defines the dashboard method.

    {
// This is the opening brace for the dashboard method.

        $session = session();
// This gets the session instance.

        if (! $session->get('LoggedIn')) {
// Checks if not logged in.

            $session->setFlashdata('error', 'Please log in first!');
// Sets error flash message.

            return redirect()->to(base_url('login'));
// Redirects to login.

        }
// Closes if.

        if ($session->get('status') === 'restricted') {
// Checks if user status is 'restricted'.

            $session->destroy();
// Destroys the session.

            return redirect()->to(base_url('restricted/user'));
// Redirects to a restricted page.

        }
// Closes if.

        return view('auth/dashboard');
// Returns the dashboard view.

    }
// This is the closing brace for the dashboard method.

    // --- Logout User ---
// This is a comment indicating the logout method.

    public function logout()
// This defines the logout method.

    {
// This is the opening brace for the logout method.

        session()->destroy();
// This destroys the current session, logging out the user.

        return redirect()->to(base_url('login'));
// This redirects to the login page.

    }
// This is the closing brace for the logout method.
    public function forgot() {
        return view('auth/forgot_password');
    }

     public function reset() {
        return view('auth/reset');
    }

    public function getEmail() {
        $db = Database::connect();

        // Delete verification records older than 3 minutes
        $db->table('verifications')
        ->where('created_at <', date('Y-m-d H:i:s', strtotime('-3 minutes')))
        ->delete();
        $session = session();
        helper(['form']);
        $data = [];
        $email    = $this->request->getPost('email');

         $rules = [
                 'email' => [
                    'label'  => 'Email Address',
                    'rules'  => 'required|valid_email|regex_match[/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/]',
                    'errors' => [
                        'regex_match' => 'The {field} format is invalid.',
                    ]
                ],
         ];

          if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                return view('auth/forgot_password', $data);
         }

         $db = Database::connect();
         $user = $db->table('users')->where('email', $email)->get()->getRow();

         if (! $user) {
            $session = session();
            $session->setFlashdata('error', 'Email not found.');
            return redirect()->back()->withInput();
        }

         $otp = mt_rand(100000, 999999);

        $db->table('verifications')->where('email', $email)->delete();
        $db->table('verifications')->insert([
            'email' => $email,
            'verification_code'   => $otp,
            'created_at' =>  date('Y-m-d H:i:s'),
            'status' => 'unused',
        ]);

        $mail = new PHPMailer(true);

         try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'marketingj786@gmail.com';
            $mail->Password   = 'orxk bcjn eqdf nzsb';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('marketingj786@gmail.com', 'LMS Verification');
            $mail->addAddress($email);

            $mail->Subject = 'Your Password Reset Code';
            $mail->Body    = "Your OTP code is: <b>$otp</b>";

            $mail->isHTML(true);
            $mail->send();

        } catch (Exception $e) {
            $session->setFlashdata('error', 'Could not send email.');
            return redirect()->back();
        }

        $session->set('reset_email', $email);

        return redirect()->to('/forgot')->with('success', 'Verification code sent to your email.');
    }

    public function getCode() {
        $session = session();
        helper(['form']);
        $data = [];
        $code    = $this->request->getPost('code');
        $rules = [
        'code' => [
                'label'  => 'Code',
                'rules'  => 'required|numeric',
                'errors' => [
                'numeric' => 'The {field} must contain only numbers.',
                ]
        ],
        ];

        if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                return view('auth/forgot_password', $data);
         }

         $db = Database::connect();
         $user = $db->table('verifications')->where('verification_code', $code)->get()->getRow();
         
         if (! $user) {
             $session = session();
             $session->setFlashdata('error', 'Invalid code.');
             return redirect()->back()->withInput();
        }

        if ($user->status === 'used') {
            $session = session();
            $session->setFlashdata('error', 'This code has already been used.');
            return redirect()->back()->withInput();
        }
        $db->table('verifications')->where('verification_code', $code)->update([
            'status' => 'used',
        ]);
        return redirect()->to('/reset')->with('success', 'Code verified. You can now reset your password.');
    }

    public function changePassword() {
        helper(['form']);
        $data = [];

        $this->request->getPost('password');
        $this->request->getPost('confirm_password');
        $rules = [
            'password' => [
                'label'  => 'New Password',
                'rules'  => 'required|min_length[8]|max_length[255]|regex_match[/^(?!.*[\*"]).+$/]',
                'errors' => [
                    'regex_match' => 'The {field} cannot contain * or ".'
                ]
            ],
            'confirm_password' => 'matches[password]'
        ];

        if (! $this->validate($rules)) {
            $data['validation'] = $this->validator;
            return view('auth/reset', $data);
        }

        $newPassword = $this->request->getPost('password');
        $email = session()->get('reset_email');

        $db = Database::connect();
        $db->table('users')->where('email', $email)->update([
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        session()->remove('reset_email');
        session()->setFlashdata('success', 'Password updated successfully! Please log in.');

        return redirect()->to(base_url('login'));

        }
}
// This is the closing brace for the Auth class.
