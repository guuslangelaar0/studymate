<?php

namespace App\Services;

use Illuminate\Http\Request;

class UserService
{
    public function __construct()
    {

    }

    public function encryptPasswordInData($data){
        if($data['password'] !== $data['confirm_password']){
            throw new \Exception("Passwords do not match");
        }
        if(!empty($data['password'])){
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password'], $data['confirm_password']);
        }
        return $data;
    }



}
