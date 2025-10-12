<?php

namespace Module\MyPosyandu\Policies;

use Illuminate\Auth\Access\Response;
use Module\System\Models\SystemUser;
use Module\MyPosyandu\Models\MyPosyanduComplaint;

class MyPosyanduComplaintPolicy
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
        return $user->hasPermission('view-myposyandu-complaint');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, MyPosyanduComplaint $myPosyanduComplain): bool
    {
        return $user->hasPermission('show-myposyandu-complaint');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-myposyandu-complaint');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, MyPosyanduComplaint $myPosyanduComplain): bool
    {
        return $user->hasPermission('update-myposyandu-complaint');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, MyPosyanduComplaint $myPosyanduComplain): bool
    {
        return $user->hasPermission('delete-myposyandu-complaint');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, MyPosyanduComplaint $myPosyanduComplain): bool
    {
        return $user->hasPermission('restore-myposyandu-complaint');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, MyPosyanduComplaint $myPosyanduComplain): bool
    {
        return $user->hasPermission('destroy-myposyandu-complaint');
    }
}
