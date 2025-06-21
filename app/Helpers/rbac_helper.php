<?php

use App\Models\UserRoleModel;
use App\Models\RoleModel;

function user_has_role($userId, $roleName): bool
{
    $roleModel = new RoleModel();
    $userRoleModel = new UserRoleModel();

    $role = $roleModel->where('name', $roleName)->first();
    if (!$role) return false;

    return $userRoleModel
        ->where('user_id', $userId)
        ->where('role_id', $role['id'])
        ->countAllResults() > 0;
}
