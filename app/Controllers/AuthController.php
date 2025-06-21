<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\UserRoleModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        //
    }

    public function registration()
    {
        helper(['form']);
        return view('pages/registration');
    }

    public function store()
    {
        helper(['form']);
        $rules = [
            'username' => 'required|min_length[3]|max_length[20]',
            'email'    => 'required|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return view('pages/registration', [
                'validation' => $this->validator
            ]);
        }

        $model = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $model->save($data);
        $userId = $model->insertID(); // get ID of inserted user

          // Assign role
    $roleName = $this->request->getPost('role');
    $roleModel = new \App\Models\RoleModel();
    $userRoleModel = new \App\Models\UserRoleModel();

    $role = $roleModel->where('name', $roleName)->first();

    if ($role) {
        $userRoleModel->insert([
            'user_id' => $userId,
            'role_id' => $role['id']
        ]);
    }
        return redirect()->to('/login')->with('success', 'Registration successful!');
    }

    // ✅ Show login form
    public function login()
    {
        helper(['form']);
        return view('pages/login');
    }

    // ✅ Handle login logic
    public function authenticate()
    {
        $session = session();
        $request = service('request');
        $username = $request->getPost('username');
        $password = $request->getPost('password');

        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            
            // ✅ Instantiate the UserRoleModel
            $userRoleModel = new UserRoleModel();


            $role = $userRoleModel
            ->select('roles.name')
            ->join('roles', 'roles.id = user_roles.role_id')
            ->where('user_roles.user_id', $user['id'])
            ->first();
            
            
            // Set session
            $session->set([
            'user_id'    => $user['id'],
            'username'   => $user['username'],
            'role'       => $role['name'] ?? 'user', // fallback
            'isLoggedIn' => true,
        ]);

            return redirect()->to('/admin');
        } else {
            return redirect()->back()->with('error', 'Invalid username or password');
        }
    }

     public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
