<?php

namespace App\Models;

use Shanmuga\LaravelEntrust\Models\EntrustRole;

class Role extends EntrustRole
{
    
    protected function deleteRoleById($id){
        
        $role = Role::find($id);
        if($role){
            return $role->delete();
        }
        return false;
    }
}
