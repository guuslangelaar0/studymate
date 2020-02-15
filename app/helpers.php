<?php

if (! function_exists('checkPermissions')) {
    function checkPermissions($name, $exception = true) {
        foreach (auth()->user()->roles as $role){
            $permission = $role->permissions->where('name',$name)->first();
            if($permission != null){
                return true;
            }
        }
        if($exception) {
            abort(401, 'Unauthorized');
        }
        return false;
    }
}
