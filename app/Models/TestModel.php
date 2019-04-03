<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TestModel extends Model
{
    protected $tableName='test';

    public function getProb($tid)
    {
        $list=DB::table("test_problem")->where(["tid"=>$tid])->join("problem","problem.pid","=","test_problem.pid")->orderBy('pcode', 'asc')->select("test_problem.pid as pid","pcode","desc","choiceA","choiceB","choiceC","choiceD")->get()->all();
        foreach($list as &$l){
            $l["choices"]=[];
            if(!is_null($l["choiceA"])){
                $l["choices"][]=[
                    "content"=>$l["choiceA"],
                    "md5"=>md5($l["choiceA"])
                ];
            }
            if(!is_null($l["choiceB"])){
                $l["choices"][]=[
                    "content"=>$l["choiceB"],
                    "md5"=>md5($l["choiceB"])
                ];
            }
            if(!is_null($l["choiceC"])){
                $l["choices"][]=[
                    "content"=>$l["choiceC"],
                    "md5"=>md5($l["choiceC"])
                ];
            }
            if(!is_null($l["choiceD"])){
                $l["choices"][]=[
                    "content"=>$l["choiceD"],
                    "md5"=>md5($l["choiceD"])
                ];
            }
            shuffle($l["choices"]);
        }
        return $list;
    }

    public function basic($tid)
    {
        $info=DB::table($this->tableName)->where(["tid"=>$tid])->get()->first();
        $info["remaining"]=time()-strtotime($info["due_time"]);
        return $info;
    }
}
