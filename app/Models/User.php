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
        'username','firstname', 'lastname','email', 'password','google_id'
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
        return $this->belongsToMany(Exam::class, 'user_exams')->withPivot(['file', 'tag', 'finished', 'created_at', 'updated_at']);
    }

    public function getFirstnameAttribute($value) {
        return decrypt($value);
    }

    public function getLastnameAttribute($value) {
        return decrypt($value);
    }

    public function getEmailAttribute($value) {
        return decrypt($value);
    }

    public function setFirstnameAttribute($value) {
        $this->attributes['firstname'] = encrypt($value);
    }

    public function setLastnameAttribute($value) {
        $this->attributes['lastname'] =  encrypt($value);
    }

    public function setEmailAttribute($value) {
        $this->attributes['email'] =  encrypt($value);
    }




}
