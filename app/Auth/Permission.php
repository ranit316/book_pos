<?php

namespace App\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class Permission
{

    public static function check($permission_route_name)
    {
        $autherized = false;
        // here i have checked the user admin or not
        if (
            auth()->user()->type === "admin" || 
            (
                auth()->user()->role_id == 3 || 
                (
                    auth()->user()->role_id == 1 || 
                    (
                        auth()->user()->role_id == 5 || 
                        (
                            auth()->user()->role_id == 6 || 
                            (
                                auth()->user()->role_id == 7 || 
                                auth()->user()->role_id == 8 ||
                                auth()->user()->role_id == 4
                            )
                        )
                    )
                )
            )
        ) {
            $authorized = true;
            return $authorized;
        }
        $data =   DB::table('permissions')->where('role_id', auth()->user()->role_id)->whereIn('name', $permission_route_name)->first();
        if (!empty($data)) {
            $autherized = true;
        }


        return $autherized;
    }

    public static function getAllowedRoute()
    {

        $route_name = 'dashboard.show';
        // foreach (auth()->user()->role as $role) {
        //     $data =   DB::table('permissions')->where("role_id", $role->id)->where('route_name', 'like', "%index%")->where('route_name', 'NOT LIKE', "%-%")->first();
        //     if (!empty($data)) {
        //         $route_name = $data->route_name;
        //         break;
        //     }
        // }
        return $route_name;
    }



    public static function renamePermission(string $now_permission, array $permissions)
    {
        return $permissions[$now_permission] ?? $now_permission;
    }
}
