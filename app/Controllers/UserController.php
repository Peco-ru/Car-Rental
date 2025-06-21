<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class UserController extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    protected $format    = 'json';

    // GET /users
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    // GET /users/{id}
    public function show($id = null)
    {
        $data = $this->model->find($id);
        return $data ? $this->respond($data) : $this->failNotFound('User not found');
    }

    // POST /users
    public function create()
    {
        $data = $this->request->getJSON(true);

        // Optional: hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        if ($this->model->insert($data)) {
            $data['id'] = $this->model->getInsertID();
            return $this->respondCreated($data);
        }

        return $this->failValidationErrors($this->model->errors());
    }

    // PUT /users/{id}
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        // Optional: hash new password if provided
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        if ($this->model->update($id, $data)) {
            return $this->respond($this->model->find($id));
        }

        return $this->failValidationErrors($this->model->errors());
    }

    // DELETE /users/{id}
    public function delete($id = null)
    
    {
        $userModel = new \App\Models\UserModel();
        $db = \Config\Database::connect();

        // Start transaction to ensure data consistency
        $db->transStart();

        // First, delete related user_roles
        $db->table('user_roles')->where('user_id', $id)->delete();

        // Then delete the user
        $userModel->delete($id);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->to('/users')->with('error', 'Failed to delete user due to related records.');
        }

        return redirect()->to('pages/userlist')->with('message', 'User deleted successfully');
    }


}
