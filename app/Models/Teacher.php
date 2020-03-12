<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $fillable = [
        'firstname', 'lastname', 'email',
    ];
    public $timestamps = false;

    public function modules(){
        return $this->belongsToMany(Module::class, 'module_teachers')->withPivot('coordinator');
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
