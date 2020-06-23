<?php

namespace App\Policies;

use App\Models\AdminUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminUserPolicy
{
    use HandlesAuthorization;

    /**
     * @param  AdminUser  $user
     * @return bool
     */
    public function viewAny(AdminUser $user)
    {
        return $user->is_owner;
    }

    /**
     * @param  AdminUser  $user
     * @param  AdminUser  $adminUser
     * @return bool
     */
    public function view(AdminUser $user, AdminUser $adminUser)
    {
        return $user->is_owner || $user->id === $adminUser->id;
    }

    /**
     * @param  AdminUser  $user
     * @return bool
     */
    public function create(AdminUser $user)
    {
        return $user->is_owner;
    }

    /**
     * @param  AdminUser  $user
     * @param  AdminUser  $adminUser
     * @return bool
     */
    public function update(AdminUser $user, AdminUser $adminUser)
    {
        return $user->is_owner || $user->id === $adminUser->id;
    }

    /**
     * @param  AdminUser  $user
     * @param  AdminUser  $adminUser
     * @return bool
     */
    public function delete(AdminUser $user, AdminUser $adminUser)
    {
        return $user->is_owner && $user->id !== $adminUser->id;
    }

    /**
     * @param  AdminUser  $user
     * @param  AdminUser  $adminUser
     * @return bool
     */
    public function changeAuthority(AdminUser $user, AdminUser $adminUser)
    {
        return $user->is_owner && $user->id !== $adminUser->id;
    }
}
