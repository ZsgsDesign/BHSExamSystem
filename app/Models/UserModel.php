<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    public $table="users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=[
        'name', 'email', 'password', 'avatar', 'contest_account'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden=[
        'password', 'remember_token',
    ];

    public static function findExam($uid,$eid){
        $basic=DB::table("test")->where(["eid"=>$eid,"uid"=>$uid])->orderBy('score', 'desc')->first();
        return empty($basic)?"/":$basic["score"];
    }

    public static function exams(){
        return DB::table("exam")->where(["available"=>1])->get()->all();
    }

    public static function export()
    {
        $userList=DB::table("users")->select("id","name","email as SID")->get()->all();
        $ret=['学号', '姓名'];
        $exams=UserModel::exams();
        foreach ($exams as $e) {
            $ret[]=$e["exam_name"];
        }
        $ret=[$ret];
        foreach ($userList as $u) {
            $rowContent=[$u["SID"],$u["name"]];
            foreach ($exams as $e) {
                $rowContent[]=UserModel::findExam($u['id'], $e["eid"]);
            }
            $ret[]=$rowContent;
        }
        return $ret;
    }
}
