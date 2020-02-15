<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';
    protected $fillable = [
        'name', 'short_name',
    ];
    public $timestamps = false;


    public function teachers(){
        return $this->belongsToMany(Teacher::class, 'module_teachers')->withPivot('coordinator');
    }

    public function coordinators(){
        return $this->belongsToMany(Teacher::class, 'module_teachers')->withPivot('coordinator')->where('coordinator', true);
    }

}
