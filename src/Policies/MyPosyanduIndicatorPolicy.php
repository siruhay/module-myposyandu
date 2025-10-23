<?php

namespace Module\MyPosyandu\Policies;

use Module\System\Models\SystemUser;
use Module\MyPosyandu\Models\MyPosyanduIndicator;
use Illuminate\Auth\Access\Response;

class MyPosyanduIndicatorPolicy
{
    /**
    * Perform pre-authorization checks.
    */
    public function before(SystemUser $user, string $ability): bool|null
    {
        if ($user->hasLicenseAs('myposyandu-superadmin')) {
            return true;
        }
    
        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function view(SystemUser $user): bool
    {
        return $user->hasPermission('view-myposyandu-indicator');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, MyPosyanduIndicator $myPosyanduIndicator): bool
    {
        return $user->hasPermission('show-myposyandu-indicator');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-myposyandu-indicator');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, MyPosyanduIndicator $myPosyanduIndicator): bool
    {
        return $user->hasPermission('update-myposyandu-indicator');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, MyPosyanduIndicator $myPosyanduIndicator): bool
    {
        return $user->hasPermission('delete-myposyandu-indicator');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, MyPosyanduIndicator $myPosyanduIndicator): bool
    {
        return $user->hasPermission('restore-myposyandu-indicator');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, MyPosyanduIndicator $myPosyanduIndicator): bool
    {
        return $user->hasPermission('destroy-myposyandu-indicator');
    }
}
