<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Exam extends Model
{
    protected $table = 'exams';
    protected $fillable = [
        'label','start_date', 'end_date', 'type'
    ];

    public $timestamps = false;

    public function modules() {
        return $this->belongsTo(Module::class);
    }

    public static function getPossibleTypes(){
        return ['assessment','prelim'];
    }


}
