<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ExamModel extends Model
{
    protected $tableName='exam';

    public function list($uid)
    {
        $list=DB::table($this->tableName)->where(["available"=>1])->orderBy('exam_due', 'asc')->get()->all();
        foreach($list as &$l){
            $l["score"]=DB::table("test")->where(["eid"=>$l["eid"],"uid"=>$uid])->orderBy('score', 'desc')->first()["score"];
        }
        return $list;
    }

    public function detail($eid, $uid)
    {
        $basic=DB::table($this->tableName)->where(["available"=>1,"eid"=>$eid])->get()->first();
        if(empty($basic)){
            return null;
        }
        $basic["score"]=DB::table("test")->where(["eid"=>$basic["eid"],"uid"=>$uid])->orderBy('score', 'desc')->first()["score"];
        return $basic;
    }

    public function basic($eid)
    {
        return DB::table($this->tableName)->where(["eid"=>$eid])->get()->first();
    }
}
