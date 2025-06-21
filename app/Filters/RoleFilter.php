<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $userId = $session->get('user_id');
        $requiredRole = $arguments[0] ?? null;

        if (!$userId || !$requiredRole) {
            return redirect()->to('/login');
        }

        $roleModel = new \App\Models\RoleModel();
        $role = $roleModel->where('user_id', $userId)->first();

        if (!$role || $role['name'] !== $requiredRole) {
            return Services::response()
                ->setStatusCode(403)
                ->setBody('Access Denied');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)

    { 
        
        // No post-processing required

    }
}
