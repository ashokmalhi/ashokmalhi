<?php

namespace App\Models;

use Shanmuga\LaravelEntrust\Models\EntrustPermission;
use Session;

class Permission extends EntrustPermission {


    protected function get_user_permissions($id) {

        $perm = $this->select("permissions.name as name")
                        ->leftJoin("permission_role as mpr", "permissions.id", '=', 'mpr.permission_id')
                        ->leftJoin("roles as r", "r.id", '=', 'mpr.role_id')
                        ->leftJoin("role_user as mru", "mru.role_id", '=', 'r.id')
                        // ->leftJoin("map_role_users as mru","mru.role_id",'=','r.id')
                        // ->leftJoin("users as u","u.id",'=','mru.user_id')
                        ->leftJoin("users as u", "u.id", '=', 'mru.user_id')
                        // ->where("u.id",$id)->get();
                        ->where("u.id", $id)->get();
        $permission_array = array();
        foreach ($perm as $val) {
            $permission_array[] = $val->name;
        }
        Session::put('user_permissions', $permission_array);
    }

}
