<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class ChangePassword extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function changePassword()
    {
        helper(['form']);

        if ($this->request->is('post')) {
            $rules = [
               'password' => [
                            'label'  => 'Password',
                            'rules'  => 'required|min_length[8]|max_length[255]|regex_match[/^(?!.*[\*"]).+$/]',
                            'errors' => [
                                        'regex_match' => 'The {field} cannot contain * or ".'
                                    ]
                ],
                'confirm_password' => 'required|matches[password]',
            ];

            if (! $this->validate($rules)) {
                // Validation failed
                session()->setFlashdata('error_change', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }

            $userId = session()->get('user_id'); // assuming you stored user_id in session after login

            if (! $userId) {
                session()->setFlashdata('error_change', 'User not logged in.');
                return redirect()->back();
            }

            $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

            $this->userModel->update($userId, [
                'password' => $hashedPassword,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            session()->setFlashdata('success_change', 'Password updated successfully!');
            return redirect()->to(base_url('dashboard')); // redirect wherever appropriate
        }

        return redirect()->back();
    }
}
