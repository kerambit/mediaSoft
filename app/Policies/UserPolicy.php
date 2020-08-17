<?php

namespace App\Policies;

use App\Checklist;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user have permission.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response
     */
    public function index(User $user)
    {
        foreach ($user->roles as $role){
            if ($role->name == 'Admin' or $role->name == 'Manager'){
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the user have permission to edit user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response
     */
    public function edit(User $user)
    {
        foreach ($user->roles as $role){
            if ($role->name == 'Admin' or $role->name == 'Manager'){
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the user have permission to update user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user)
    {
        foreach ($user->roles as $role){
            if ($role->name == 'Admin' or $role->name == 'Manager'){
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the user have permission to ban user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response
     */
    public function destroy(User $user)
    {
        foreach ($user->roles as $role){
            if ($role->name == 'Admin'){
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the user have permission to restore user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response
     */
    public function restore(User $user)
    {
        foreach ($user->roles as $role){
            if ($role->name == 'Admin'){
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the user have permission
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response
     */
    public function showChecklist(User $user)
    {
        foreach ($user->roles as $role){
            if ($role->name == 'Admin' or $role->name == 'Manager'){
                return true;
            }
        }
        return false;
    }
}
