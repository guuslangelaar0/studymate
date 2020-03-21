<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Exam extends Model
{
    protected $table = 'exams';
    protected $fillable = [
        'label','start_date', 'end_date', 'type', 'module_id','ec'
    ];

    public $timestamps = false;

    public function module() {
        return $this->belongsTo(Module::class);
    }

    public static function getPossibleTypes(){
        return ['assessment','prelim'];
    }


}
