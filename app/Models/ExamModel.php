<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ExamModel extends Model
{
    protected $tableName='exam';

    public function list()
    {
        return DB::table($this->tableName)->where(["available"=>1])->orderBy('exam_due', 'asc')->get()->all();
    }
}
