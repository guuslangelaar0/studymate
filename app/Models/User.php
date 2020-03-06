<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'firstname', 'lastname','email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class,'user_roles');
    }

    public function modules() {
        return $this->belongsToMany(Module::class, 'user_modules');
    }

    public function exams() {
        return $this->belongsToMany(Exam::class, 'user_exams');
    }


}
