<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';
    protected $fillable = [
        'name', 'short_name','block'
    ];
    public $timestamps = false;


    public function teachers() {
        return $this->belongsToMany(Teacher::class, 'module_teachers')->withPivot('coordinator');
    }

    public function coordinators() {
        return $this->belongsToMany(Teacher::class, 'module_teachers')->withPivot('coordinator')->where('coordinator', true);
    }

    public function exams() {
        return $this->hasMany(Exam::class);
    }

    public function getPeriodAttribute() {
        $block = $this->block;
        switch(true) {
            case in_array($block, [1,2,3,4]):
                return 1;
                break;
            case in_array($block, [5,6,7,8]):
                return 2;
                break;
            case in_array($block, [9,10,11,12]):
                return 3;
                break;
            case in_array($block, [13,14,15,16]):
                return 4;
                break;
            default:
                return 0;
                break;
        }

    }

}
