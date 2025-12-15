<?php
// This is the opening PHP tag, indicating the start of PHP code execution.

namespace App\Controllers;
// This declares the namespace for the controller class, organizing it under App\Controllers for better code structure and autoloading.

use App\Models\UserModel;
// This imports the UserModel class from the App\Models namespace, allowing the controller to interact with the user data model.

use CodeIgniter\Controller;
// This imports the base Controller class from CodeIgniter, which this class extends to inherit controller functionality.
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Config\Database;

class AdminUserController extends Controller
// This defines the AdminUserController class, which extends the base Controller class, making it a controller for handling admin user-related actions.

{
// This is the opening brace for the class definition.

    protected $userModel;
// This declares a protected property $userModel, which will hold an instance of the UserModel for database interactions.

    public function __construct()
// This defines the constructor method, which is called when an instance of the class is created.

    {
// This is the opening brace for the constructor method.

        helper(['url', 'form']);
// This loads the 'url' and 'form' helpers from CodeIgniter, providing utility functions for URL manipulation and form handling.

        $this->userModel = new UserModel();
// This instantiates a new UserModel object and assigns it to the $userModel property for use in the class methods.

    }
// This is the closing brace for the constructor method.

    // 🟢 Show User Management Page
    // This is a comment indicating the purpose of the following method: to display the user management page.

    public function index()
// This defines the index method, which is typically the default method called when accessing the controller.

    {
// This is the opening brace for the index method.

        if (!session()->get('LoggedIn') || session()->get('user_role') !== 'admin') {
// This checks if the user is not logged in or if their role is not 'admin'; if true, access is denied.

        return redirect()->to(base_url('login'))->with('error', 'Access denied.');
// This redirects the user to the login page with an error message if access is denied.

    }
// This is the closing brace for the if statement.

    $data['users'] = $this->userModel->findAll();
// This retrieves all users from the database using the UserModel's findAll method and stores them in the $data array under the 'users' key.

    // Make sure this matches your actual file name (case-sensitive on Linux)
    // This is a comment reminding to ensure the view file name matches exactly, as Linux is case-sensitive.

    return view('allUser', $data);
// This loads and returns the 'allUser' view, passing the $data array containing the users list.

    }
// This is the closing brace for the index method.

    // 🟩 Add New User
    // This is a comment indicating the purpose of the following method: to add a new user.

    public function addUser()
// This defines the addUser method for handling the addition of new users.

    {
// This is the opening brace for the addUser method.

        helper(['form']);
// This loads the 'form' helper, providing functions for form handling.

        $message = [];
// This initializes an empty array for messages, though it's not used in the code.

        if($this->request->is('post')) {
// This checks if the current request is a POST request, indicating form submission.

        // Define validation rules for adding a new user
        // This is a comment explaining the following array defines validation rules.

        $rules = [
        // This starts the array definition for validation rules.

                'name' => [
                // This defines validation rules for the 'name' field.

                    'label'  => 'Full Name',
                    // This sets the label for the 'name' field for error messages.

                    'rules'  => 'required|min_length[3]|max_length[50]|regex_match[/^[A-Za-z\s]+$/]', // Name must be required and match regex
                    // This specifies the validation rules: required, minimum 3 characters, maximum 50, and must match the regex for letters and spaces.

                    'errors' => [
                    // This starts the array for custom error messages for the 'name' field.

                        'regex_match' => 'The {field} may only contain letters and spaces.' // Custom error message for regex match
                        // This defines a custom error message for regex mismatch.

                    ]
                // This closes the 'name' field array.

                ],
                'email' => [
                // This defines validation rules for the 'email' field.

                    'label'  => 'Email Address',
                    // This sets the label for the 'email' field.

                    'rules'  => 'required|valid_email|is_unique[users.email]|regex_match[/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/]', // Email must be valid and unique
                    // This specifies rules: required, valid email, unique in users table, and match email regex.

                    'errors' => [
                    // This starts the array for custom error messages for the 'email' field.

                        'regex_match' => 'The {field} contains invalid characters.', // Custom error message for regex match
                        // Custom error for regex mismatch.

                        'is_unique'   => 'That email is already registered.' // Custom error message for unique check
                        // Custom error for non-unique email.

                    ]
                // This closes the 'email' field array.

                ],
                'role' => [
                // This defines validation rules for the 'role' field.

                    'label'  => 'User Role',
                    // This sets the label for the 'role' field.

                    'rules'  => 'required|in_list[admin,teacher,student, Admin,Teacher,Student]', // Role must be one of the specified values
                    // This specifies rules: required and must be in the list of allowed roles (case variations included).

                    'errors' => [
                    // This starts the array for custom error messages for the 'role' field.

                        'in_list' => 'The {field} must be either admin, teacher, or student.' // Custom error message for role validation
                        // Custom error for invalid role.

                    ]
                // This closes the 'role' field array.

                ],
            ];
        // This closes the $rules array.

            // Validate the input data against the defined rules
            // This is a comment explaining the validation check.

            if($this->validate($rules)) {
            // This validates the POST data against the rules; if valid, proceeds.

                $defaultPassword = "Lms_2025";
                // This sets a default password for new users.

                // Prepare new user data for insertion into the database
                // This is a comment explaining the data preparation.

                $newUser = [
                // This starts the array for new user data.

                    'name' => $this->request->getPost('name'), // Get the name from the form
                    // This retrieves the 'name' from the POST data.

                    'email' => $this->request->getPost('email'), // Get the email from the form
                    // This retrieves the 'email' from the POST data.

                    'role' => $this->request->getPost('role'), // Get the role from the form
                    // This retrieves the 'role' from the POST data.

                    'status' => 'restricted', // Set initial status to 'restricted'),

                    'password' => password_hash($defaultPassword, PASSWORD_DEFAULT), // Hash the password
                    // This hashes the default password using PHP's password_hash function.

                    'created_at' => date('Y-m-d H:i:s'), // Set the current timestamp for creation
                    // This sets the creation timestamp to the current date and time.

                    'updated_at' => date('Y-m-d H:i:s') // Set the current timestamp for update
                    // This sets the update timestamp to the current date and time.

                ];
                // This closes the $newUser array.

                // Attempt to insert the new user data into the database
                // This is a comment explaining the insertion attempt.

                $insertBatch = \Config\Database::connect()->table('users')->insert($newUser);
                // This connects to the database, selects the 'users' table, and inserts the new user data, storing the result in $insertBatch.

                // Check if the insertion was successful
                // This is a comment explaining the success check.

                if($insertBatch) {
                // This checks if the insertion was successful.

                   session()->setFlashdata('success', 'New User Invited Successfully!');
                   // This sets a success flash message in the session.

                   $email = $this->request->getPost('email');

                     $db = Database::connect();
                     $user = $db->table('users')->where('email', $email)->get()->getRow();
                     $user_id = $user->id;  

                     $link = 'http://localhost/ITE311-ALCAYDE/verify_account/'.$user_id;

                    $db->table('validations')
                    ->where('created_at <', date('Y-m-d H:i:s', strtotime('-3 minutes')))
                    ->delete();
                      $db->table('validations')->insert([
                    'email' => $email,
                    'validation_link'   => $link,
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

                            $mail->Subject = 'Your invited to LMS please verify your account';
                            $mail->Body    = "Please Click this link to verify your account: <b>$link</b>";

                            $mail->isHTML(true);
                            $mail->send();

                        } catch (Exception $e) {
                            $session->setFlashdata('error', 'Could not send email.');
                            return redirect()->back();
                        }

                   return redirect()->to(base_url('users')); // Redirect to user management
                   // This redirects to the users page.

                } else {
                // This is the else branch for failed insertion.

                  session()->setFlashdata('error', 'Failed to add user. Please try again.');
                  // This sets an error flash message.

                  return redirect()->back()->withInput(); // Redirect back with input data
                  // This redirects back to the form with input data preserved.

                }
                // This closes the if-else for insertion check.

            } else {
            // This is the else branch for failed validation.

                session()->setFlashdata('validation', $this->validator->getErrors());
            return redirect()->back()->withInput(); // Capture validation errors
            // This sets validation errors in flashdata and redirects back with input.

            }
            // This closes the if-else for validation.

        }
        // This closes the if for POST request check.

         $data['users'] = $this->userModel->findAll();
         // This retrieves all users again for the view.

        // Make sure this matches your actual file name (case-sensitive on Linux)
        // This is a comment about the view file name.

        return view('allUser', $data);
        // This loads the 'allUser' view with the data.

    }
    // This is the closing brace for the addUser method.

    // Update User Info
    // This is a comment indicating the purpose: to update user information.

    public function updateUser($id)
    // This defines the updateUser method, taking a user ID as parameter.

    {
    // This is the opening brace for the updateUser method.

         $validationRules = [
         // This starts the array for validation rules for updating.

            'name'     => [
            // This defines rules for 'name'.

                    'label'  => 'Full Name',
                    // Label for 'name'.

                    'rules'  => 'required|min_length[3]|max_length[50]|regex_match[/^[A-Za-z\s]+$/]', // Name must be required and match regex
                    // Rules for 'name'.

                    'errors' => [
                    // Custom errors for 'name'.

                        'regex_match' => 'The {field} may only contain letters and spaces.' // Custom error message for regex match
                        // Custom error.

                    ]
            // Closes 'name' array.

            ],
            'role'     =>  [
            // Defines rules for 'role'.

                    'label'  => 'User Role',
                    // Label for 'role'.

                    'rules'  => 'required|in_list[admin,teacher,student]', // Role must be one of the specified values
                    // Rules for 'role'.

                    'errors' => [
                    // Custom errors for 'role'.

                        'in_list' => 'The {field} must be either admin, teacher, or student.' // Custom error message for role validation
                        // Custom error.

                    ]
                // Closes 'role' array.

                ],
        ];
        // Closes $validationRules array.

        $user = $this->userModel->find($id);
        // This finds the user by ID.

        if (!$user) {
        // Checks if user exists.

            return redirect()->back()->with('error', 'User not found.');
        // Redirects back with error if not found.

        }
        // Closes if.

         $password = "lms_2025";
         // This sets a hardcoded password (note: this seems insecure).

        if (!$this->validate($validationRules)) {
        // Validates against rules.

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // Redirects back with errors if invalid.

        }
        // Closes if.

        $data = [
        // Starts array for update data.

            'name'  => $this->request->getPost('name'),
            // Gets 'name' from POST.

            'role'  => $this->request->getPost('role'),
            // Gets 'role' from POST.

            'status'=> $this->request->getPost('status'),
            // Gets 'status' from POST.

            'password'   => password_hash($password, PASSWORD_DEFAULT),
            // Hashes the password.

            'updated_at' => date('Y-m-d H:i:s'),
            // Sets update timestamp.

        ];
        // Closes $data array.

        $this->userModel->update($id, $data);
        // Updates the user in the database.

        return redirect()->to(base_url('users'))->with('success', 'User updated successfully!');
        // Redirects to users page with success message.

    }
    // This is the closing brace for the updateUser method.

    // Restrict or Unrestrict User
    // This is a comment indicating the purpose: to toggle user restriction status.

    public function toggleRestriction($id)
    // This defines the toggleRestriction method, taking user ID.

    {
    // This is the opening brace for the toggleRestriction method.

        $user = $this->userModel->find($id);
        // Finds the user by ID.

        if (!$user) {
        // Checks if user exists.

            return redirect()->back()->with('error', 'User not found.');
        // Redirects back with error if not found.

        }
        // Closes if.

        $newStatus = $user['status'] === 'granted' ? 'restricted' : 'granted';
        // Toggles the status between 'granted' and 'restricted'.

        $this->userModel->update($id, ['status' => $newStatus]);
        // Updates the user's status in the database.

        $msg = $newStatus === 'restricted' ? 'User restricted.' : 'User access restored.';
        // Sets a message based on the new status.

        return redirect()->to(base_url('users'))->with('success', $msg);
        // Redirects to users page with the appropriate success message.

    }

    public function verifyAccount($id)
    {
        $db = Database::connect();
        $user = $db->table('users')->where('id', $id)->update(['status' => 'granted']);


        if (!$user) {
            return redirect()->to(base_url('login'))->with('error', 'Invalid verification link.');
        }

        // Update user status to 'granted' upon verification
        $this->userModel->update($id, ['status' => 'granted']);

        return redirect()->to(base_url('login'))->with('success', 'Account verified successfully! You can now log in.');
    }
    // This is the closing brace for the toggleRestriction method.
}
// This is the closing brace for the AdminUserController class.
