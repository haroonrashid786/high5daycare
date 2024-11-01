<?php
namespace App\Authorization;
use App\Role;
trait RoleTrait
{
    // $user->hasRole('admin','editor')

    public function hasRole(...$roles)
    {

        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }

    public function roles()
    {

        return $this->belongsToMany(Role::class, 'users_roles');

    }
}

